<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Support\Facades\Gate;


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $candidates = Candidate::with('student', 'job')->advancedFilter();
        return response()->json($candidates);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function show(Candidate $candidate)
    {
        return response()->json($candidate->load(['student', 'job']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        if (Gate::allows('check-if-candidate')) {
            $candidate = Candidate::create(
                collect($request->only('job_id'))->merge([
                    'student_id' => auth()->user()->student->id,
                    'status' => 'new',
                    'rank' => 0
                ])->toArray()
            );
            if ($media = $request->input('resume')) {
                Media::where('id', $media['id'])
                    ->where('model_id', 0)
                    ->update(['model_id' => $candidate->id]);
            }
            return response()->json([
                'status' => true,
                'message' => "Candidate Added successfully!",
                'student' => $candidate
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Unauthorized",
            ], 403);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Candidate $candidate
     * @return JsonResponse
     */
    public function update(Request $request, Candidate $candidate)
    {
        if (Gate::allows('update-candidate', [$request->user(), $candidate])) {
            // Able to use job in $candidate because candidate model has candidate-jobs relation.
            if($candidate->job->user_id == $request->user()->id){
                $candidate->update($request->only('status'));
                return response()->json([
                    'status' => true,
                    'message' => "Candidate Updated successfully!",
                    'candidate' => $candidate
                ], 200);
            }
        } else {
            // The company is not authorized
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Candidate $candidate
     * @return Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }


    public function uploadResume(Request $request)
    {
        $this->validate($request, [
            'file' => [
                'max:' . 1024 * 2
            ],
        ]);

        $model = new Candidate();
        $model->id = $request->input('model_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('file')->toMediaCollection('resume');

        return response()->json($media, ResponseAlias::HTTP_CREATED);
    }

    public function updateStatusMultiple(Request $request) {
        $ids = $request->get('ids');
        Candidate::whereIn('id', $ids)->update([
            'status' => 'shortlisted'
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Candidate updated successfully'
        ]);
    }
}

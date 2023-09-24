<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();
        return response()->json($candidates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('check-if-candidate', [$request->user()])) {
            $candidate = Candidate::create($request->only('user_id', 'job_id', 'rank', 'status'));
            return response()->json([
                'status' => true,
                'message' => "Candidate Added successfully!",
                'candidate' => $candidate
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
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
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
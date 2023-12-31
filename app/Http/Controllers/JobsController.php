<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'jobs' => Jobs::with('user')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $jobs = Jobs::create(
            collect($request->all())->merge([
                'user_id' => auth()->id()
            ])->toArray()
        );

        return response()->json([
            'status' => true,
            'message' => "Jobs Created successfully!",
            'jobs' => $jobs
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Jobs $jobs
     * @return JsonResponse
     */
    public function show(Jobs $jobs)
    {
        $jobs->load('user');
        return response()->json([
            'status' => true,
            'jobs' => $jobs
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function showByUser(User $user)
    {
        // dd($user);
        $user->load('jobs', 'jobs.user');
        return response()->json([
            'status' => true,
            'user_created_jobs' => $user->jobs
        ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Jobs $jobs
     * @return Response
     */
    public function edit(Jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Jobs $jobs
     * @return JsonResponse
     */
    public function update(Request $request, Jobs $jobs)
    {
        $jobs->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Jobs Updated successfully!",
            'jobs' => $jobs
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Jobs $jobs
     * @return JsonResponse
     */
    public function destroy(Jobs $jobs)
    {
        $jobs->delete();

        return response()->json([
            'status' => true,
            'message' => "Jobs Deleted successfully!",
        ], 200);
    }
}

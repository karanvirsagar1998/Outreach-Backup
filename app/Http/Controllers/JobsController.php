<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'jobs' => Jobs::with('user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobs = Jobs::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Jobs Created successfully!",
            'jobs' => $jobs
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobs  $jobs
     * @return \Illuminate\Http\Response
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
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
     * @param  \App\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobs  $jobs
     * @return \Illuminate\Http\Response
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
     * @param  \App\Jobs  $jobs
     * @return \Illuminate\Http\Response
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
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
            'colleges' => College::orderBy('name')->get()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $college = College::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "College Created successfully!",
            'college' => $college
        ], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\College $college
     * @return \Illuminate\Http\Response
     */
    public function show(College $college)
    {
        return response()->json([
            'status' => true,
            'college' => $college
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\College $college
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\College $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, College $college)
    {
        $college->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "College Updated successfully!",
            'college' => $college
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(College $college)
    {
        $college->delete();

        return response()->json([
            'status' => true,
            'message' => "College Deleted successfully!",
        ], 200);
    }
}

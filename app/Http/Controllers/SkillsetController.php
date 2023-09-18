<?php

namespace App\Http\Controllers;

use App\Models\Skillset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillsetController extends Controller
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
            'skillset' => Skillset::orderBy('name')->get()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //Validated
            $validation = ['name' => 'required'];

            $validate = Validator::make($request->all(), $validation);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $skillset = Skillset::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "Skillset Created successfully!",
                'skill' => $skillset
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function show(Skillset $skillset)
    {
        return response()->json([
            'status' => true,
            'skill' => $skillset
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function edit(Skillset $skillset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skillset $skillset)
    {
        $skillset->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Skillset Updated successfully!",
            'skillset' => $skillset
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skillset $skillset)
    {
        $skillset->delete();

        return response()->json([
            'status' => true,
            'message' => "Skillset Deleted successfully!",
        ], 200);
    }
}

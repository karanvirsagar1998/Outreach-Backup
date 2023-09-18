<?php

namespace App\Http\Controllers;

use App\Models\CompanySkillset;
use Illuminate\Http\Request;

class CompanySkillsetController extends Controller
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
            'skillsNeed' => CompanySkillset::with('skill')->get()
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
        $skillset = CompanySkillset::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Company skillset need created successfully!",
            'skillset' => $skillset
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanySkillset  $companySkillset
     * @return \Illuminate\Http\Response
     */
    public function show(CompanySkillset $companySkillset)
    {
        return response()->json([
            'status' => true,
            'skillsetNeed' => $companySkillset
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanySkillset  $companySkillset
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanySkillset $companySkillset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanySkillset  $skillsetNeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanySkillset $companySkillset)
    {
        $companySkillset->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Company Skillset Updated successfully!",
            'skillset' => $companySkillset
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanySkillset  $skillsetNeed
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanySkillset $skillsetNeed)
    {
        $skillsetNeed->delete();

        return response()->json([
            'status' => true,
            'message' => "Company Skillset deleted successfully!",
        ], 200);
    }
}

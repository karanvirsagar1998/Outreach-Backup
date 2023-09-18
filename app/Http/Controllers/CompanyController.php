<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'company' => Company::with('user', 'student')->get()
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'id' => 0,
        ]);

        $validate = $this->validateForm($request);

        if (!$validate->getData()->status) {
            return $validate;
        }

        $company = Company::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Company Created successfully!",
            'company' => $company
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Company $company)
    {
        $company->load('skillsets','skillsets.skill','rankings','rankings.student');
        return response()->json([
            'status' => true,
            'company' => $company
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Company $company)
    {
        $request->merge([
            'id' => $company->id,
        ]);

        $validate = $this->validateForm($request);

        if (!$validate->getData()->status) {
            return $validate;
        }

        $company->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Company Updated successfully!",
            'company' => $company
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Company $company)
    {
        $company->skillsets()->delete();
        $company->delete();

        return response()->json([
            'status' => true,
            'message' => "Company Deleted successfully!",
        ], 200);
    }

    private function validateForm($request) {

        $response =  response()->json([
            'status' => true
        ], 200);

        $validation = array();

        if ($request->get('id') > 0) {
            $validation = [
                'email' => 'required|email|unique:company,email,'.$request->get('id')
            ];
        } else {
            $validation = [
                'email' => 'required|email|unique:company,email'
            ];
        }

        try {
            //Validated
            $validate = Validator::make($request->all(), $validation);

            if($validate->fails()){
                $response = response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }
        } catch (\Throwable $th) {
            $response = response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        return $response;

    }

}

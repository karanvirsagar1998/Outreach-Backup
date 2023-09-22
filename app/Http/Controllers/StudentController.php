<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Throwable;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $students = Student::with('college')->advancedFilter();

        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
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

        $student = Student::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Student Created successfully!",
            'student' => $student
        ], 200);

    }

    private function validateForm($request)
    {

        $response = response()->json([
            'status' => true
        ], 200);

        $validation = array();

        if ($request->get('id') > 0) {
            $validation = [
                'email' => 'required|email|unique:student,email,' . $request->get('id')
            ];
        } else {
            $validation = [
                'email' => 'required|email|unique:student,email'
            ];
        }
        try {
            //Validated
            $validateUser = Validator::make($request->all(), $validation);
            if ($validateUser->fails()) {
                $response = response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
        } catch (Throwable $th) {
            $response = response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        return $response;

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
     * @param Student $student
     * @return Response
     */
    public function show(Student $student)
    {
        $student->load('companies', 'skillsets', 'skillsets.skill', 'college');

        return response()->json([
            'status' => true,
            'completeSkills' => $this->processStudentCompleteSkills($student),
            'student' => $student
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function showSkillset(Student $student)
    {
        $student->load('skillsets', 'skillsets.skill');

        return response()->json([
            'status' => true,
            'skillsets' => $student->skillsets
        ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function update(Request $request, Student $student)
    {
        $request->merge([
            'id' => $student->id,
        ]);
        $validate = $this->validateForm($request);

        if (!$validate->getData()->status) {
            return $validate;
        }

        $student->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Student Updated successfully!",
            'student' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return Response
     */
    public function destroy(Student $student)
    {

        if (count($student->companies)) {
            foreach ($student->companies as $company) {
                $company->skillsets()->delete();
                $company->delete();
            }
        }

        $student->companies()->delete();
        $student->skillsets()->delete();
        $user_id = $student->user_id;
        $student->delete();

        $user = User::find($user_id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => "Student Deleted successfully!",
        ], 200);
    }
}
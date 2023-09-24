<?php

namespace App\Http\Controllers;

use App\Models\Invitee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InviteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitees = Invitee::with('job')->advancedFilter();
        return response()->json($invitees);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $inviteesArr = [];
        $emails = $request->emails;
        if (Gate::allows('check-authentication', [$request->user()])) {
            foreach($emails as $email){
                $inviteesArr[] = [
                    'job_id' => $request->job_id,
                    'test_id' => $request['test_id'],
                    'email' => $email,
                    'link_activation_time' => $request['link_activation_time'],
                    'link_expiry_time' => $request['link_expiry_time'],
                    'reply_to' => $request['reply_to'],
                    'status' => 'NEW',
                ];
            }
            // Insert multiple records using associtive array
            $invitees = Invitee::insert($inviteesArr);
            return response()->json([
                'status' => true,
                'message' => "Invites send successfully",
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
     * @param  \App\Invitee  $invitee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitee $invitee)
    {
        if (Gate::allows('check-authentication', [$request->user()])) {
            $invitee->update($request->only('status'));
            return response()->json([
                'status' => true,
                'message' => "Invitee Updated successfully!",
                '$invitee' => $invitee
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Unauthorized",
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invitee  $invitee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitee $invitee)
    {
        $invitee->delete();

        return response()->json([
            'status' => true,
            'message' => "Invitee Skillset deleted successfully!",
        ], 200);
    }
}
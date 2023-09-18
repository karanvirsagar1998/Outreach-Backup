<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Notifications\WelcomeEmailNotification;

class VerifyEmailController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        try{
            $user = User::find($id);
            abort_if(!$user, 403);
            abort_if(!hash_equals($hash, sha1($user->getEmailForVerification())), 403);

            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                event(new Registered($user));
            }

            //generate random password
            $random_password = uniqid();
            $user->update(['password' => Hash::make($random_password)]);

            $data = [
                'email' => $user->email,
                'name' => $user->name,
                'password' => $random_password
            ];

            $user->notify(new WelcomeEmailNotification($data));

            return ['message'=> 'Email has been verified',];

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function resendNotification(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return ['message'=> 'OK.'];
    }
}

<?php

namespace App\Http\Controllers\Api;


use App\User;
use App\Models\Student;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Registered;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email|unique:users,email',
                'name' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user =  User::create([
                'email' => $request->email,
                'name' => $request->name,
                'user_type_id' => $request->user_type_id
                //'password' => Hash::make('password') this is for testing purposes. should not be in live
            ]);

            event(new Registered($user));

            $student  = null;
            if ( $request->user_type_id == 3 ) {
                $student=  Student::create([
                    'email' => $request->email,
                    'user_id' => $user->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user,
                'student' =>  $student
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
                'mfacode' => 'nullable|integer',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->with('userType', 'student')->first();

            if (!$user->enable) {
                return response()->json([
                    'status' => false,
                    'message' => 'User is disabled. Please contact admin.',
                ], 500);
            } else if (!$user->hasVerifiedEmail()) {
                return response()->json([
                    'status' => false,
                    'message' => 'User is not yet verified. Please check your email.',
                ], 200);
            }  else if ($user->google2fa_secret === null) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                    'user' => $user
                ], 200);
            } else {
                $google2fa = new Google2FA();
                $valid = $google2fa->verifyKey($user->google2fa_secret, "".$request->mfacode);
                if ($valid) {
                    return response()->json([
                        'status' => true,
                        'message' => 'User Logged In Successfully',
                        'token' => $user->createToken("API TOKEN")->plainTextToken,
                        'user' => $user
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid code.',
                    ], 401);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function mfaQrcode() {
        $google2fa = new Google2FA();
        $user = auth()->user();
        if ($user->google2fa_secret === null) {
            $secretKey = $google2fa->generateSecretKey();
            $user->update([
                'google2fa_secret' => $secretKey
            ]);
            $qrCodeUrl = $google2fa->getQRCodeUrl(
                "Outreach",
                $user->email,
                $secretKey
            );
        } else {
            $qrCodeUrl = $google2fa->getQRCodeUrl(
                "Outreach",
                $user->email,
                $user->google2fa_secret
            );
        }
//        return QrCode::format('svg')->generate($qrCodeUrl);
        return response()->json([
            'data' => base64_encode(QrCode::format('svg')->generate($qrCodeUrl))
        ]);
    }
}

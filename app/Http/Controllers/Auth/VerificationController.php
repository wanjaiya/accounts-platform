<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserVerification;
use App\Models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }



    public function show(Request $request, $id)
    {
        return view('auth.verify', ['id' => $id]);
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user' => ['required'],
            'token' => ['required', 'string'],
        ]);
    }


    public function verifyAccount(Request $request){
        $data = $request->all();

        $validator = $this->validator($data);

        if ($validator->fails()) {
            $errors = $validator->errors();

            //return response()->json($errors,400);
            return redirect()->back()->withErrors($errors);
        }

        $verify = UserVerification::where('user_id', $data['user'])->where('token', $data['token'])->first();

        if($verify){

         $user = User::find($data['user']);
         $user->email_verified_at = now();
         $user->save();
        }

        return redirect()->route('login')->with('success', 'Your account has been verified. You can now login.');

    }
}

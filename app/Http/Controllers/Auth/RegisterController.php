<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserVerification;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function register(Request $request){

    $data = $request->all();

    $validator = $this->validator($data);

        if ($validator->fails()) {
            $errors = $validator->errors();

            //return response()->json($errors,400);
            return redirect()->route('register')->withErrors($errors);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2
        ]);

        if ($user) {


            $vcode = self::generateRandomString(6);

            $validate = new UserVerification();
            $validate->user_id = $user->id;
            $validate->token = $vcode;
            $validate->save();

            $mail = Mail::send('emails.account_verify',['name' => $user->name, 'token' => $validate->token],
                function ($message) use ($user) {
                    $message->from('komenpeter53@gmail.com', 'Welcome to Accounts Platform');
                    $message->to($user->email, $user->name);
                    $message->subject('The Account Verification');
                }
            );
            return redirect()->route('user.account_verify', [$user->id])->with('success', 'Your account has been successfully created. Please check your email for further instructions.');




        }

   }


    /**
     * Generates a random string of the given length
     *
     * @param int $length The length of the string. Defaults to 6.
     * @return string The random string.
     */
    protected function generateRandomString($length = 6)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }



}

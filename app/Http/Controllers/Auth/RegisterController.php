<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Helpers\RandomPasswordGenerator;
use App\Mail\AccountCreatedWithTempPwdMail;
use App\Notifications\SMSMobileVerification;
use Carbon\Carbon;
use Dotenv\Result\Success;
use Illuminate\Http\Response;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function requestAccess(Request $request) {
        $data = $request->validate([
            'email' => 'required|email:rfc,dns'
        ]);

        $user = User::where('email', '=', $data['email'])->first();
        if($user === null) {
            $tempPassword = RandomPasswordGenerator::makeAlphaNumeric(16);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($tempPassword)
            ]);
            Mail::to($user->email)->send(new AccountCreatedWithTempPwdMail($tempPassword));
            return response()->json([
                'user' => $user
            ]);
        } else {
            // this email already exists
            return response()->json([
                'errors' => ['This email is already in use.']
            ]);
        }
    }

    protected function smsVerification(Request $request) {
        $data = $request->all();
        $user = User::find($data['user']['id']);
        if(array_key_exists('phone', $data)) {
            $user->phone = $data['phone'];
            $user->save();
        }

        $user->notify(new SMSMobileVerification());

        return response()->json([
            'user' => $user
        ]);
    }

    protected function phoneVerified(Request $request) {
        $data = $request->all();
        $user = User::find($data['user']['id']);
        $user->phone_verified_at = Carbon::now()->toDateTimeString();
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }

    protected function saveUserDetails(Request $request) {
        $data = $request->all();
        $user = User::find($data['user']['id']);
        $user->name = $data['firstname'];
        $user->surname = $data['lastname'];
        $user->honorific = $data['title'];
        $user->company = $data['company'];

        if($user->save()) {
            return response(200);
        } else {
            return response()->json([
                'error' => 'User did not save'
            ],500);
        }
    }
}

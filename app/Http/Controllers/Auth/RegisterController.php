<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

use App\Mail\UserRequestedAccess;
use App\Notifications\SMSMobileVerification;
use Carbon\Carbon;

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
        // $this->middleware('guest');
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

    protected function showRequestAccess()
    {
        return response()->view('auth/request-access', ['user' => Auth::user()]);
    }

    protected function requestAccess(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email:rfc,dns'
        ]);

        $user = User::where('email', '=', $data['email'])->first();
        if ($user === null) {
            return response(200);
        } else {
            // this email already exists
            return response()->json([
                'errors' => ['This email is already in use. Please check your email and <a href="/login">login.</a>']
            ]);
        }
    }

    protected function smsVerification(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user']['id']);
        if (array_key_exists('phone', $data)) {
            $user->phone = $data['phone'];
            $user->save();
        }

        $user->notify(new SMSMobileVerification());

        return response()->json([
            'user' => $user
        ]);
    }

    protected function phoneVerified(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user']['id']);
        $user->phone_verified_at = Carbon::now()->toDateTimeString();
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }

    protected function saveUserDetails(Request $request)
    {
        $data = $request->all();

        $user = new User;

        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->honorific = $data['title'];
        $user->name = $data['firstname'];
        $user->surname = $data['lastname'];
        $user->company = $data['company'];

        if ($user->save()) {
            $admins = User::where('role', 1)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new UserRequestedAccess($user));
            }
            return response(200);
        } else {
            return response()->json([
                'error' => 'User did not save'
            ], 500);
        }
    }
}

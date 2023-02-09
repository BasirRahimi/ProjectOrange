<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccessController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('has_access', 0)->get();

        return view('grant-access', ['users' => $users]);
    }

    public function grantAccess(Request $request, $user_id) {
        $user = User::find($user_id);
        
        if(!$user) return response('User not found');

        $user->has_access = 1;

        if($user->save()) {
            return response('User granted access');
        } else {
            return response('User didn\'t save', 500);
        }
    }

    public function denyAccess(Request $request, $user_id) {
        $user = User::find($user_id);
        
        if(!$user) return response('User not found');

        if($user->delete()) {
            return response('User deleted');
        } else {
            return response('User didn\'t delete', 500);
        }
    }
}

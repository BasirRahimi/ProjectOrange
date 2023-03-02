<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    public function index(Request $request, $case_type)
    {
        $user = Auth::user();

        // TODO: Paginate results
        $page = $request['page'];
        $per_page = $request['per-page'];

        // TODO: Phase out the use of clients by removing/renaming clients to probate cases

        return response($user->clients->toJson(), 200);
    }
}

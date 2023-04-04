<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $user_type = Auth::user()->user_type;

        if ($user_type == 1) {
            return view('admin.home');
        }
        return view('dashboard');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        $user = Auth::guard('admin')->user();
        
        $username = $user->name;
        $email = $user->email;
        
        return view('admin.top', compact('username', 'email'));
    }

}

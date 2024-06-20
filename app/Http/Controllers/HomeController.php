<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        switch ($user->type) {
            case 'admin':
                return redirect()->route('admin.dashboard.index');
            case 'user':
                return view('index'); 
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'User type not recognized.');
        }
    }
}

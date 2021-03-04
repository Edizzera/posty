<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        
            'email' => 'required|email|',
            'password' => 'required',
        ]);

        //sign th user
        $credentials = $request->only(['email', 'password']);
        $remember = $request->remember;
        if(!Auth::attempt($credentials,$remember)) {
            return back()->with('status', 'Invalid Login Details');
        };

        return redirect('dashboard');
    }
}

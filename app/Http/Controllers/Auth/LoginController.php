<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        $remember = $request->remember === "on" ? true : false;
            
        if(auth()->attempt($request->only('email', 'password'), $remember)){
            $user = Auth::user();


        }

        return redirect()->route('admin.index');
        
        
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
      }

}
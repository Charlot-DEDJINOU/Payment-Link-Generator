<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function postLogin(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withInput()->withErrors(['error' => 'Email ou mot de passe incorrect']);
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);
        
        if ($validator->fails()) {
            return view('dashboard.registerAdmin')->with('error',$validator->errors());
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Admin créé avec succès');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getLogin() 
    {
        return view('admin.login');
    }

    public function getRegister() 
    {
        return view('dashboard.registerAdmin');
    }
}

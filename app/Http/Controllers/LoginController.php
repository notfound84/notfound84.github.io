<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginproses(Request $request)
    {
        $data = $request->input();
        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            return redirect('home');
        }
        'Alert'::error('Terjadi Kesalahan', 'Username atau Password Salah !');
        return \redirect('login');
    }
}

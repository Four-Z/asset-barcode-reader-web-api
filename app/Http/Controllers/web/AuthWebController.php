<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthWebController extends Controller
{
    public function login_page()
    {
        return view("login-page");
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || $request->password !== $user->password || $user->role !== 'admin') {
            alert()->error('Login Gagal', 'username atau password salah');

            if ($user->role != 'admin') {
                alert()->error('Login Gagal', 'role tidak sesuai');
            }

            return redirect()->route('login_page');
        }

        return redirect()->route('home_page');
    }
}

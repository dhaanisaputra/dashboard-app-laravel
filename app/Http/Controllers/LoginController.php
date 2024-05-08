<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.auth-login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            // 'usertypes' => $request->userTypes,
        ];

        if (Auth::attempt($credentials)) {
            // var_dump($credentials);
            // $user = User::findOrFail($credentials);
            if (auth()->user()->userTypes == 'operator') {
                return redirect()->route('operator.home')->with('success', 'Login Berhasil');
            } elseif (auth()->user()->userTypes == 'admin') {
                return redirect()->route('admin.home')->with('success', 'Login Berhasil');
            } else {
                // return redirect()->route('login')->with('Anda belum terdaftar');
                return back()->with('error', 'Anda belum terdaftar');
            }
            // return var_dump($credentials);
            // return redirect('/home')->with('success', 'Login Berhasil');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    // public function authenticated(Request $request, $user)
    // {
    //     if ($user->userTypes == 'operator') {
    //         return redirect()->route('operatorpage');
    //     } elseif ($user->userTypes == 'admin') {
    //         return redirect()->route('home');
    //     } else {
    //         return redirect()->route('login');
    //     }
    // }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

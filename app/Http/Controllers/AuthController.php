<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(url('/dashboard'));
        }

        $title = 'login';
        return view('auth.login', [
            'title' => $title,
        ]);
    }

    public function authLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect('/login')->with(['notification' => 'wrong username or password.']);
        }

        $grades = DB::select(DB::raw('CALL gradesById(' . Auth::user()->id . ')'));

        if (count($grades) < 1) {
            $grades = (object) ['grade' => 0, 'position' => 'admin'];
        } else {
            $grades = $grades[0];
        }
        Session::put('grades', $grades);
        return redirect('/dashboard');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(url('/login'))->with(['notification' => 'anda telah berhasil logout. ']);
    }
}

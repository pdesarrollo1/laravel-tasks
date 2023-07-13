<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public  function SignupIndex()
    {
        return view('login.signup');
    }

    public function SignupStore(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = User::create($request->all());

        auth()->login($user);
        return redirect()->route('tasks.index');
    }
    public function SessionDestroy()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function SigninIndex()
    {
        return view('login.signin');
    }

    public function SigninStore()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt($data)) {
            return redirect()->route('tasks.index');
        }
        throw ValidationException::withMessages([
            'error' => 'The Provider Email or Password is Incorrect',
        ]);
    }
}

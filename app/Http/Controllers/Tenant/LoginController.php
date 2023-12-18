<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public  function SignupIndex()
    {
        return view('login.signup');
    }

    public function SignupStore(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            // 'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            'company' => 'required|min:3|max:255'
        ], [
            'password.regex' => 'La contraseña debe contener al menos una letra, un número y un carácter especial.',
        ],);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> "2020*",
            'company' => $request->company,
            'global_id' => Str::slug($request->name, '-')
        ]);


        auth()->login($user);
        return redirect()->route('tasks.index');
        return $request->all();
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
            session()->regenerate();
            return redirect()->route('tasks.index');
        }
        throw ValidationException::withMessages([
            'error' => 'The Provider Email or Password is Incorrect',
        ]);
    }
}

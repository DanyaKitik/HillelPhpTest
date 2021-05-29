<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function form()
    {
        return view('register');
    }

    public function register()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'username' => 'required|min:5|max:255',
                'email' => 'required|email',
                'password' => 'required|min:8|max:255'
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator->errors())
                ->withInput(request()->all());
        }
        if (User::where('email', request('email'))->first() === null) {
            if (request('password') !== request('password-confirm')) {
                return redirect('register')
                    ->withErrors(['password' => 'Password mismatch']);
            }
            if (User::where('username', request('username'))->first() !== null) {
                return redirect('register')
                    ->withErrors(['username' => 'User with this username already exists']);
            }
            $user = new User();
            $user->name = \request('name');
            $user->username = request('username');
            $user->email = request('email');
            $user->email_verified_at = now();
            $user->password = Hash::make(request('password'));
            $user->remember_token = Str::random(10);
            $user->save();
            Auth::login($user);

            return redirect('/');
        }
        return redirect('register')
            ->withErrors(['email' => 'User with this email already exists']);
    }
}

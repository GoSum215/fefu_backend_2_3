<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        if(Auth::check()) {
            return redirect()->route('profile');
        }
        if($request->isMethod('post')) {
            $request['login'] = strtolower($request['login']);
            $validated = $request->validate(
                RegistrationRequest::rules()
            );

            $user = new User();
            $user->login = $validated['login'];
            $user->password = Hash::make($validated['password']);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->save();
            Auth::login($user);
            return redirect()->route('profile');
        }
        return view('registration');
    }
}

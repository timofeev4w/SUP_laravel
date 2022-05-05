<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManagerValidationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function registration()
    {
        if (Auth::check()) {
            return redirect(route('manager'));
        }

        return view('manager.user');
    }

    public function registrationStore(Request $request)
    {
    
       

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        // $user = 

        // dd($validated);

        $manager = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
        // dd($manager->only(['email', 'password']));
        // dd($validated);
        // dd(Auth::attempt($manager->only(['email', 'password'])));
        // dd(Auth::attempt($validated));
        // dd(Auth::login([
        //     'email' => $request->input('email'),
        //     'password' => bcrypt($request->input('password'))
        // ]));
        // dd(Auth::login($manager));



        if($manager) {
            // dd(Auth::attempt($validated));
            Auth::login($manager);
            // $request->session()->regenerate();

            return redirect(route('manager'));
        }

        // if($manager) {
        //     dd(Auth::attempt(($validated)));
        //     // Auth::attempt();
        //     // dd(Auth::attempt($validated));
        //     // $request->session()->regenerate();

        //     return redirect(route('manager'));
        // }

        // return back()->withErrors([]);
    }
}

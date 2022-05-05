<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerValidationRequest;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManagersController extends Controller
{
    public function index()
    {
        // dd(Auth::guard('manager')->user());
        return view('manager.index');
    }

    public function registration()
    {
        if (Auth::guard('manager')->check()) {
            return redirect(route('manager'));
        }

        return view('manager.registration');
    }

    public function registrationStore(ManagerValidationRequest $request)
    {
        $validated = $request->validated();

        $request->validate([
            'name' => 'unique:managers'
        ]);

        $manager = Manager::create($validated);

        if($manager) {
            auth()->guard('manager')->login($manager);

            return redirect(route('manager'));
        }
    }


    public function login()
    {
        if (Auth::guard('manager')->check()) {
            return redirect(route('manager'));
        }

        return view('manager.login');
    }

    public function loginPost(ManagerValidationRequest $request)
    {
        $validated = $request->validated();

        if (Auth::guard('manager')->attempt($validated)) {
            $request->session()->regenerate();
 
            return redirect()->intended(route('manager'));
        }

        return back()->withErrors([
            'name' => 'Неверное имя пользователя или пароль.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function getReport()
    {
        return view('manager.report');
    }
}

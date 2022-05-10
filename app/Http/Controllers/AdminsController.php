<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;

class AdminsController extends Controller
{
    // Show admin index
    public function index()
    {
        return view('admin.index');
    }

    // Show page for admin login
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('admin'));
        }

        return view('admin.login');
    }

    // Check admin & login
    public function loginPost(AdminValidationRequest $request)
    {
        $validated = $request->validated();

        if (Auth::guard('admin')->attempt($validated)) {
            $request->session()->regenerate();

            return redirect(route('admin'));
        }

        return back()->withErrors([
            'name' => 'Неверное имя пользователя или пароль.',
        ])->onlyInput('name');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    // Show page for create manager
    public function managerCreate()
    {
        return view('admin.manager_registration');
    }

    // Check & save manager
    public function managerStore(AdminValidationRequest $request)
    {
        $validated = $request->validated();

        $request->validate([
            'name' => 'unique:managers'
        ]);

        $manager = Manager::create($validated);

        if($manager) {
            return redirect(route('admin'))->withInput();
        }
    }
}

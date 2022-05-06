<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerValidationRequest;
use App\Models\Manager;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ManagersController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sortby' => [
                'nullable',
                Rule::in(['created_at', 'updated_at'])
            ],
            'sortmethod' => [
                'nullable',
                Rule::in(['asc', 'desc'])
            ],
            'date-start' => 'nullable|date_format:Y-m-d',
            'date-end' => 'nullable|date_format:Y-m-d',
        ]);
        // dd($request->get('sortby'));
        // if(isset($request->get('sortby')) && isset($request->get('sort'))) {
        //     $clients = Client::orderBy($request->get('sortby'), $request->get('sort'))
        //     ->paginate(15);
        // }
        // $date_start = $request->get('date-start').' 00:00:00';
        // $date_end = $request->get('date-end').' 23:59:59';


        // if($request->get('sortby') != null && $request->get('sortmethod') != null && $request->get('date-start') != null && $request->get('date-end') != null) {
        //     $date_start = $request->get('date-start').' 00:00:00';
        //     $date_end = $request->get('date-end').' 23:59:59';

        //     $clients = Client::orderBy($request->get('sortby'), $request->get('sortmethod'))
        //         ->where($request->get('sortby'), '>=', $date_start)
        //         ->where($request->get('sortby'), '<=', $date_end)
        //         ->paginate(15);
        // }else{
        //     $clients = Client::orderBy('created_at', 'desc')
        //         ->paginate(15);
        // }

        $clients = Client::getClientsByDate($request->get('sortby'), $request->get('sortmethod'), $request->get('date-start'), $request->get('date-end'));
        // dd($clients);

        $date_start = strtotime(Client::min('created_at'));
        $date_start = date('Y-m-d', $date_start);

        $date_end = strtotime(Client::max('updated_at'));
        $date_end = date('Y-m-d', $date_end);

        // dd($date_start);
        
        // $clients = $clients->sortByDesc();
        // $clients->values()->all();
        // dd($clients->links());
        // dd($clients);
        // dd(Auth::guard('manager')->user());
        return view('manager.index', [
            'clients' => $clients,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);
    }

    public function getClient(int $id = 1)
    {
        $client = Client::where('id', $id)
            ->get();
        dd($client);

        return view('manager.client');
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerValidationRequest;
use App\Http\Requests\ClientValidationRequest;
use App\Models\Manager;
use App\Models\Client;
use App\Models\City;
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

        $clients = Client::getClientsByDate($request->get('sortby'), $request->get('sortmethod'), $request->get('date-start'), $request->get('date-end'), $request->get('city'));

        $cities = City::all('name');

        $date_start = strtotime(Client::min('created_at'));
        $date_start = date('Y-m-d', $date_start);

        $date_end = strtotime(Client::max('updated_at'));
        $date_end = date('Y-m-d', $date_end);

        return view('manager.index', [
            'clients' => $clients,
            'cities' => $cities,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);
    }

    public function getClient(int $id)
    {
        $client = Client::where('id', $id)
            ->first();

        return view('manager.client', [
            'client' => $client
        ]);
    }

    // Show page for input changes
    public function edit(int $id)
    {
        $client = Client::where('id', $id)
            ->first();

            // dd($client);

        return view('manager.client_edit', [
            'client' => $client
        ]);
    }

    // Update city and client
    public function update(ClientValidationRequest $request, $id)
    {
        $request->validated();

        $city = City::firstOrCreate([
            'name' => $request->input('city')
        ]);

        Client::where('id', $id)
            ->update([
                'secondname' => ucfirst($request->input('secondname')),
                'firstname' => ucfirst($request->input('firstname')),
                'patronymic' => ucfirst($request->input('patronymic')),
                'city_id' => $city->id,
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone')
            ]);

        return redirect('/manager/client/'.$id);
    }

    public function destroy(int $id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect(route('manager'));
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

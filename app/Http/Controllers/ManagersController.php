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
    // Show all clients or with filter
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

        $clients = Client::getClientsByDatePaginate($request->get('sortby'), $request->get('sortmethod'), $request->get('date-start'), $request->get('date-end'), $request->get('city'));

        session(['manager_filter_url' => url()->full()]);

        $cities = City::all('name');

        // For min & max date input from user
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

    // Show client by id
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

    // Delete client by id
    public function destroy(int $id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect(session('manager_filter_url'));
    }
    
    // Show login page for managers
    public function login()
    {
        if (Auth::guard('manager')->check()) {
            return redirect(route('manager'));
        }

        return view('manager.login');
    }

    // Login managers
    public function loginPost(ManagerValidationRequest $request)
    {
        $validated = $request->validated();

        if (Auth::guard('manager')->attempt($validated)) {
            $request->session()->regenerate();
 
            return redirect()->route('manager');
        }

        return back()->withErrors([
            'name' => 'Неверное имя пользователя или пароль.',
        ])->onlyInput('name');
    }

    // Logout managers
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    // Show report page with date filter
    public function getReport(Request $request)
    {
        $validated = $request->validate([
            'date-start' => 'required|date_format:Y-m-d',
            'date-end' => 'required|date_format:Y-m-d',
        ]);

        $date_start = $request->get('date-start');
        $date_end = $request->get('date-end');

        $clients = Client::getClientsByDate($date_start, $date_end);

        $days = [];

        $i = 0;
        while ($date_start <= $date_end) {
            $days[$i]['date'] = date('d-m-Y', strtotime($date_start));
            $days[$i]['count'] = 0;
            foreach ($clients as $client) {
                if ($client->created_at->format('Y-m-d') == $date_start) {
                    $days[$i]['count']++;
                }
            }

            $date_start = strtotime($date_start);
            $date_start = date('Y-m-d', $date_start + 60*60*24);
            $i++;
        }

        // For min & max date input from user
        $date_start = strtotime(Client::min('created_at'));
        $date_start = date('Y-m-d', $date_start);

        $date_end = strtotime(Client::max('updated_at'));
        $date_end = date('Y-m-d', $date_end);

        return view('manager.report', [
            'date_start' => $date_start,
            'date_end' => $date_end,
            'days' => $days
        ]);
    }
}

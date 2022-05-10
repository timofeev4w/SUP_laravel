<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientValidationRequest;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientValidationRequest $request)
    {
        $request->validated();
        $request->validate([
            'email' => 'unique:clients',
            'phone' => 'unique:clients'
        ]);

        $city = City::firstOrCreate([
            'name' => ucfirst($request->input('city'))
        ]);

        Client::create([
            'secondname' => ucfirst($request->input('secondname')),
            'firstname' => ucfirst($request->input('firstname')),
            'patronymic' => ucfirst($request->input('patronymic')),
            'city_id' => $city->id,
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ]);

        
        return redirect('/')->withInput();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientValidationRequest;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

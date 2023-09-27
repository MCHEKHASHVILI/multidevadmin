<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clients\ClientStoreRequest;
use App\Http\Requests\Clients\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\Clients\ClientListResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Clients/Clients', [
            "clients" => ClientListResource::collection(Client::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Clients/CreateClient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreRequest $request)
    {
        $request->user()->clients()->create($request->validated());

        return to_route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return inertia('Clients/EditClient', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return inertia('Clients/EditClient', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());

        if($request->hasFile('avatar')){
            $client->clearMediaCollection('avatar');
            $client->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        return to_route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->clearMediaCollection('avatar');

        $client->delete();

        return to_route('clients.index');
    }
}

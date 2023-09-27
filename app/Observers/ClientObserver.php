<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    public function created(Client $client){
        // adding media once created
        if(request()->hasFile('avatar')){
            $client->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
    }

    public function updated(Client $client)
    {
        if (request()->hasFile('avatar')) {
            $client->clearMediaCollection('avatar');
            $client->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
    }
}

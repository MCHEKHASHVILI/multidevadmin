<?php

namespace App\Http\Resources\Clients;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company' => $this->company,
            'url' => $this->url,
            'description' => $this->description,
            'avatar' => $this->getFirstMediaUrl('avatar', 'thumb'),
        ];
    }
}

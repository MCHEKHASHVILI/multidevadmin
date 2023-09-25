<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectListResource extends JsonResource
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
            'title' => $this->title,
            'description' => substr($this->description, 0, 50) . ' ...',
            'url' => $this->url,
            'avatar' => $this->getFirstMediaUrl('avatar', 'thumb'),
            "status" => $this->latestStatus(),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'title' => $this->title,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'created_at' => $this->created_at,

            'project' => $this->whenLoaded('project'),
        ];
    }
}
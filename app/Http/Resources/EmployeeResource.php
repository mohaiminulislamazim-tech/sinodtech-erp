<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'branch' => new BranchResource($this->whenLoaded('branch')),
            'status' => $this->status,
            'salary' => (float) $this->salary,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}

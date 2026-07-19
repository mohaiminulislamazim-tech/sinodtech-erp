<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'price' => (float) $this->price,
            'category_id' => $this->category_id,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ] : null,
            'sku' => 'SKU-' . str_pad($this->id, 5, '0', STR_PAD_LEFT),
            'stock' => (int) $this->inventories->sum('quantity'),
            'branch_stock' => $this->inventories->map(function ($inv) {
                return [
                    'branch_id' => $inv->branch_id,
                    'branch_name' => $inv->branch ? $inv->branch->name : 'Unknown Branch',
                    'quantity' => (int) $inv->quantity,
                ];
            }),
        ];
    }
}

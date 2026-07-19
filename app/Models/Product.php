<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "description", "price", "category_id"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function getSkuAttribute()
    {
        return 'SKU-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}

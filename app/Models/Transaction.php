<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ["sale_id", "payment_method", "amount"];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

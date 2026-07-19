<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'sale_id', 'amount', 'type', 'description', 'reference_id', 'reference_type'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the parent referenceable model (sale, etc).
     */
    public function reference()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return SaleResource::collection(Sale::with('items.product', 'customer')->all());
    }

    public function show($id)
    {
        return new SaleResource(Sale::with('items.product', 'customer')->findOrFail($id));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Role;

class AboutController extends Controller
{
    public function index()
    {
        return view('about');
    }
}

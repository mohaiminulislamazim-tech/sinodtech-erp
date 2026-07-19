<?php

/**
 * ------------------------------------------------------------
 * SinodTech ERP
 *
 * Copyright (c) 2026 Mohaiminul Islam
 * All Rights Reserved.
 *
 * Unauthorized copying, modification, distribution,
 * or commercial use of this software without written
 * permission from the author is prohibited.
 * ------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the About page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('about');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function create()
    {
        return view("promotions.create");
    }

    public function send(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "body" => "required|string",
        ]);

        // Here you would typically dispatch a job to send the promotion to customers
        // For now, we'll just redirect back with a success message.

        return redirect()->route("promotions.create")->with("success", "Promotion sent successfully!");
    }
}

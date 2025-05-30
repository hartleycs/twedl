<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppearanceController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'dark_mode' => 'required|boolean',
        ]);
        
        session(['darkMode' => $validated['dark_mode']]);
        
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'capital' => 'required|string|max:255',
            'population' => 'required|integer',
            'region' => 'required|string|max:255',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Ajoutez d'autres validations selon les besoins
        ]);

        if ($request->hasFile('flag')) {
            $flagPath = $request->file('flag')->store('flags', 'public');
            $validatedData['flag_path'] = $flagPath;
        }

        $country = Country::create($validatedData);

        return response()->json($country, 201);
    }
}


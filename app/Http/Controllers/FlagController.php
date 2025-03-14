<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlagController extends Controller
{
    public function upload(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        if ($request->hasFile('flag')) {
            $path = $request->file('flag')->store('flags', 'public');
            $country->flag_url = Storage::url($path);
            $country->save();
        }

        return response()->json($country, 200);
    }

    public function show($id)
    {
        $country = Country::findOrFail($id);
        return response()->file(public_path($country->flag_url));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return Country::all();
    }

    public function store(Request $request)
    {
        $country = Country::create($request->all());
        return response()->json($country, 201);
    }

    public function show($id)
    {
        return Country::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());
        return response()->json($country, 200);
    }

    public function destroy($id)
    {
        Country::findOrFail($id)->delete();
        return response()->json(['message' => 'Tga3eed a 3la slamtk'], 201);
    }
}
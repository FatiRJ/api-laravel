<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitales = Hospital::all();

        return response()->json($hospitales);
    }

    public function create(Request $request)
    {
        $hospital = Hospital::create($request->all());

        return response()->json($hospital, 201);
    }

    public function show($id)
    {
        $hospital = Hospital::findOrFail($id);

        return response()->json($hospital);
    }

    public function update(Request $request, $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update($request->all());

        return response()->json($hospital);
    }

    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return response()->json(null, 204);
    }
}

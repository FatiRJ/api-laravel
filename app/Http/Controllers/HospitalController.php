<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitales = Hospital::all();

        return response()->json($hospitales);
    }

    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $hospital = Hospital::create($request->all());

        return response()->json($hospital, 201);
    }

    public function show($id)
    {
        $hospital = Hospital::find($id);

        if (!$hospital) {
            return response()->json(['error' => 'Hospital no encontrado'], 404);
        }

        return response()->json($hospital);
    }

    public function update(Request $request, $id)
    {
        $hospital = Hospital::find($id);

        if (!$hospital) {
            return response()->json(['error' => 'Hospital no encontrado'], 404);
        }

        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $hospital->update($request->all());

        return response()->json($hospital);
    }

    public function destroy($id)
    {
        $hospital = Hospital::find($id);

        if (!$hospital) {
            return response()->json(['error' => 'Hospital no encontrado'], 404);
        }

        $hospital->delete();

        return response()->json(null, 204);
    }

    private function validateRequest(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);
    }
}

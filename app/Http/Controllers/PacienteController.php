<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();

        return response()->json($pacientes);
    }

    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $paciente = Paciente::create($request->all());

        return response()->json($paciente, 201);
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        return response()->json($paciente);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $paciente->update($request->all());

        return response()->json($paciente);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        $paciente->delete();

        return response()->json(null, 204);
    }

    private function validateRequest(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);
    }
}

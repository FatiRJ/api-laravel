<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();

        return response()->json($medicos);
    }

    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $medico = Medico::create($request->all());

        return response()->json($medico, 201);
    }

    public function show($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }

        return response()->json($medico);
    }

    public function update(Request $request, $id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }

        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $medico->update($request->all());

        return response()->json($medico);
    }

    public function destroy($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }

        $medico->delete();

        return response()->json(null, 204);
    }

    private function validateRequest(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'especialidad' => 'required'
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'especialidad.required' => 'El campo especialidad es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::all();

        return response()->json($consultas);
    }

    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $consulta = Consulta::create($request->all());

        return response()->json($consulta, 201);
    }

    public function show($id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            return response()->json(['error' => 'Consulta no encontrada'], 404);
        }

        return response()->json($consulta);
    }

    public function update(Request $request, $id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            return response()->json(['error' => 'Consulta no encontrada'], 404);
        }

        try {
            $this->validateRequest($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $consulta->update($request->all());

        return response()->json($consulta);
    }

    public function destroy($id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            return response()->json(['error' => 'Consulta no encontrada'], 404);
        }

        $consulta->delete();

        return response()->json("Registro eliminado", 204);
    }

    private function validateRequest(Request $request)
    {
        $rules = [
            'fecha' => 'required'
        ];

        $messages = [
            'fecha.required' => 'El campo fecha es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);
    }
}

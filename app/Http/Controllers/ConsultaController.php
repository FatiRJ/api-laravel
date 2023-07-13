<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();

        return response()->json($departamentos);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|unique:departamentos',
            'descripcion' => 'required',
        ]);

        $departamento = Departamento::create($validatedData);

        return response()->json($departamento, 201);
    }

    public function show($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }

        return response()->json($departamento);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => [
                'required',
                Rule::unique('departamentos')->ignore($departamento->id),
            ],
            'descripcion' => 'required',
        ]);

        $departamento->update($validatedData);

        return response()->json($departamento);
    }

    public function destroy($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }

        $departamento->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();

        return response()->json($medicos);
    }

    public function create(Request $request)
    {
        $medico = Medico::create($request->all());

        return response()->json($medico, 201);
    }

    public function show($id)
    {
        $medico = Medico::findOrFail($id);

        return response()->json($medico);
    }

    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->update($request->all());

        return response()->json($medico);
    }

    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return response()->json(null, 204);
    }
}

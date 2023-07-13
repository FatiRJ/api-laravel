<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::all();

        return response()->json($consultas);
    }

    public function create(Request $request)
    {
        $consulta = Consulta::create($request->all());

        return response()->json($consulta, 201);
    }

    public function show($id)
    {
        $consulta = Consulta::findOrFail($id);

        return response()->json($consulta);
    }

    public function update(Request $request, $id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->update($request->all());

        return response()->json($consulta);
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return response()->json(null, 204);
    }

}

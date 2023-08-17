<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProximidadController extends Controller
{
    public function datos(Request $request)
    {
        $token = $request->header('X-AIO-key');
        $response = Http::withHeaders(['X-AIO-key' => $token])
            ->get('https://io.adafruit.com/api/v2/fermurilllo/feeds/distancia/data');
        $datos = $response->json();
        return response()->json([
            'status' => 'ok',
            'datos' => $datos
        ], 200);
    }
    public function ultimoDato(Request $request)
    {
        $token = $request->header('X-AIO-key');
        $response = Http::withHeaders(['X-AIO-key' => $token])
            ->get('https://io.adafruit.com/api/v2/GabrielDev/feeds/welcome-feed/data/last');
        $datos = $response->json();
        return response()->json($datos, 200);
    }
}

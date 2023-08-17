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
            ->get('https://io.adafruit.com/api/v2/fati13rj/feeds/temperatura');

        $datos = $response->json();

        // Crear un array con solo los campos que deseas
        $dataSubset = [
            "name" => $datos["name"],
            "last_value" => $datos["last_value"]
        ];
        return response()->json($dataSubset, 200);
    }

    public function obtenerTodo(Request $request)
    {
        $token = $request->header('X-AIO-key');

        // Obtener datos del feed 'temperatura'
        $responseTemperatura = Http::withHeaders(['X-AIO-key' => $token])
            ->get('https://io.adafruit.com/api/v2/fati13rj/feeds/temperatura');
        $datosTemperatura = $responseTemperatura->json();

        // Obtener datos del feed 'humedad'
        $responseHumedad = Http::withHeaders(['X-AIO-key' => $token])
            ->get('https://io.adafruit.com/api/v2/fati13rj/feeds/humedad');
        $datosHumedad = $responseHumedad->json();

        // Obtener datos del feed 'distancia'
        $responseDistancia = Http::withHeaders(['X-AIO-key' => $token])
            ->get('https://io.adafruit.com/api/v2/fati13rj/feeds/distancia');
        $datosDistancia = $responseDistancia->json();

        // Crear un array con los campos que deseas de cada feed
        $dataSubset = [
            "temperatura" => [
                "name" => $datosTemperatura["name"],
                "last_value" => $datosTemperatura["last_value"]
            ],
            "humedad" => [
                "name" => $datosHumedad["name"],
                "last_value" => $datosHumedad["last_value"]
            ],
            "distancia" => [
                "name" => $datosDistancia["name"],
                "last_value" => $datosDistancia["last_value"]
            ]
        ];

        return response()->json($dataSubset, 200);
    }
}

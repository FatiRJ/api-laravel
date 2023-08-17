<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProximidadController extends Controller
{
    private function fetchDataFromFeed($token, $feedName)
    {
        $response = Http::withHeaders(['X-AIO-key' => $token])
            ->get("https://io.adafruit.com/api/v2/fati13rj/feeds/{$feedName}");
        return $response->json();
    }

    public function datos(Request $request)
    {
        $token = $request->header('X-AIO-key');
        $datos = $this->fetchDataFromFeed($token, 'sensorvalue/data');
        return response()->json([
            'status' => 'ok',
            'datos' => $datos
        ], 200);
    }

    public function ultimoDato(Request $request)
    {
        $token = $request->header('X-AIO-key');
        $datos = $this->fetchDataFromFeed($token, 'welcome-feed/data/last');
        return response()->json($datos, 200);
    }

    public function obtenerTodo(Request $request)
    {
        $token = $request->header('X-AIO-key');

        $feeds = ['temperatura', 'humedad', 'distancia','sensorvalue','sonido'];

        $dataSubset = [];

        foreach ($feeds as $feed) {
            $feedData = $this->fetchDataFromFeed($token, $feed);
            $dataSubset[$feed] = [
                'name' => $feedData['name'],
                'last_value' => $feedData['last_value'],
                'created_at' => $feedData['created_at']
            ];
        }

        return response()->json($dataSubset, 200);
    }
}

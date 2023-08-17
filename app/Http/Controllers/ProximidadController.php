<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SensorData;

class ProximidadController extends Controller
{
    private function fetchDataFromFeed($token, $feedName)
    {
        $response = Http::withHeaders(['X-AIO-key' => $token])
            ->get("https://io.adafruit.com/api/v2/fati13rj/feeds/{$feedName}");
        return $response->json();
    }

    public function obtenerDatosFeed(Request $request, $feedName)
    {
        $token = $request->header('X-AIO-key');
        $feedData = $this->fetchDataFromFeed($token, $feedName . '/data');
    
        return response()->json([
            'status' => 'ok',
            'datos' => $feedData
        ], 200);
    }
    

    public function obtenerUltimoDato(Request $request, $feedName)
    {
        $token = $request->header('X-AIO-key');
        $datos = $this->fetchDataFromFeed($token, $feedName);

        $sensorData = new SensorData();
        $sensorData->fill([
        'feed_id' => $datos['id'],
        'name' => $datos['name'],
        'description' => $datos['description'],
        // Llena más campos aquí según la estructura de los datos
        'created_at' => $datos['created_at'],
        'updated_at' => $datos['updated_at']
    ]);

    // Guarda la instancia en la base de datos
    $sensorData->save();
    
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

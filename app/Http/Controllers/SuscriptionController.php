<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Service;
use App\Models\Suscription;
use Illuminate\Support\Facades\Auth;

class SuscriptionController extends Controller
{
    public function suscribe(Request $request)
    {
        $validated = $request->validate([
            'number_client' => ['required', 'string'], 
            'date' => ['required', 'date_format:Y-m-d'],
            'service' => ['required', 'string'],
        ]);

       if (!$client = $this->getClient($request)) {
            return response()->json([
                'status' => false,
                'message' => 'El cliente no existe.'
            ]);
        }

       if (!$service = $this->getService($request)) {
            return response()->json([
                'status' => false,
                'message' => 'El servicio no existe.'
            ]);
        }

        try {

            $suscription = new Suscription();
            $suscription->client_id = $client->id;
            $suscription->service_id = $service->id;
            $suscription->date = $request->date;

            $suscription->save();

            $user = Auth::user();

            $user->suscriptions()->attach($suscription->id);

            return response()->json([
                'status' => true,
                'message' => 'Se suscribión con éxito.',
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error en el alta de la suscripción.'
            ]);
        }
    }

    public function unsuscribe(Request $request)
    {
        $validated = $request->validate([
            'number_client' => ['required', 'string'], 
            'service' => ['required', 'string'],
        ]);

        if (!$client = $this->getClient($request)) {
            return response()->json([
                'status' => false,
                'message' => 'El cliente no existe.'
            ]);
        }

       if (!$service = $this->getService($request)) {
            return response()->json([
                'status' => false,
                'message' => 'El servicio no existe.'
            ]);
        }

        $suscription = Suscription::where([
            'client_id' => $client->id, 
            'service_id' => $service->id
        ])->first();

        if (!$suscription) {
            return response()->json([
                'status' => false,
                'message' => 'No existe la suscripción para ese cliente y ese servicio.'
            ]);
        }

        $suscription->active = false;
        $suscription->cancelled_date = Carbon::now();
        $suscription->save();

        return response()->json([
            'status' => true,
            'message' => 'Se cancelo la suscripción con éxito.',
        ]);
    }

    private function getClient(Request $request)
    {
        return Client::where('number', $request->number_client)->first();
    }

    private function getService(Request $request)
    {
        return Service::where('name', $request->service)->first();
    }
}

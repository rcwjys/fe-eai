<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AspirationController extends Controller
{
    public function create()
    {
        $response = Http::get('http://localhost:3000/api/v1/aspiration-addresses');

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspirationAddresses = $this->getAspirationAddresses($response);
            return view('aspiration.create', [
                'aspirationAddresses' => $aspirationAddresses,
            ]);
        } else {
            return view('aspiration.create', [
                'aspirationAddresses' => [],
            ]);
        }
    }

    private function getAspirationAddresses($response)
    {

        $data = $response->json();

        // Debugging log
        Log::info('Decoded JSON: ' . print_r($data, true));

        if (isset($data['data']) && is_array($data['data'])) {
            return $data['data'];
        }

        return [];
    }

    public function store(Request $request)
    {
    try {
        $validate_aspiration = $request->validate([
            'aspiration' => 'required',
            'user_id' => '6a5b455b-f990-4c2d-b585-f5011946371d',
            'aspiration_address_id' => 'required'
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer <your_token>',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post('http://localhost:3000/api/v1/aspiration/create', [
            'aspiration' => $validate_aspiration['aspiration'],
            'user_id' => $validate_aspiration['user_id'],
            'aspiration_address_id' => $validate_aspiration['aspiration_address_id']
        ]);

        if ($response->successful()) {
            return redirect()->route('route_name_for_success');
        } else {
            return redirect()->route('route_name_for_error');
        }

    } catch (\Throwable $e) {
        dd($e->getMessage());
    }
}






}

?>

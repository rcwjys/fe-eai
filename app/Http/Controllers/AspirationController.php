<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AspirationController extends Controller
{
    public function get_all_aspiration()
    {
        $response = Http::get('http://localhost:3000/api/v1/aspiration');

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspiration = $this->getAspiration($response);
            return view('admin.aspiration.index', [
                'aspiration' => $aspirationAddresses,
            ]);
        } else {
            return view('admin.aspiration.index', [
                'aspiration' => [],
            ]);
        }
    }

    private function getAspiration($response)
    {

        $data = $response->json();

        // Debugging log
        Log::info('Decoded JSON: ' . print_r($data, true));

        if (isset($data['data']) && is_array($data['data'])) {
            return $data['data'];
        }

        return [];
    }


    // public function create()
    // {
    //     $response = Http::get('http://localhost:3000/api/v1/aspiration-addresses');

    //     Log::info('API Response: ' . $response->body());

    //     if ($response->successful()) {
    //         $aspirationAddresses = $this->getAspirationAddresses($response);
    //         return view('user.aspiration.create', [
    //             'aspirationAddresses' => $aspirationAddresses,
    //         ]);
    //     } else {
    //         return view('user.aspiration.create', [
    //             'aspirationAddresses' => [],
    //         ]);
    //     }
    // }

    // private function getAspirationAddresses($response)
    // {

    //     $data = $response->json();

    //     // Debugging log
    //     Log::info('Decoded JSON: ' . print_r($data, true));

    //     if (isset($data['data']) && is_array($data['data'])) {
    //         return $data['data'];
    //     }

    //     return [];
    // }









}

?>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Throwable;

class AspirationAddressController extends Controller
{
    public function get_all_aspiration_address()
    {
        $response = Http::get('http://localhost:3000/api/v1/aspiration-addresses');

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspirationAddresses = $this->getAspirationAddresses($response);
            return view('admin.aspirationaddress.index', [
                'aspirationAddresses' => $aspirationAddresses,
            ]);
        } else {
            return view('admin.aspirationaddress.index', [
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

    public function show_create_aspiration_address_form()
    {
        return view('admin.aspirationaddress.create');
    }

    public function store_aspiration_address_data(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->post('http://localhost:3000/api/v1/aspiration-addresses', [
                'aspiration_address' => $request->aspirationaddress,
            ]);

            if ($response->successful()) {
                return redirect('/aspiration-address');
            } else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function show_aspiration_address_edit_form(Request $request)
    {
        try {
            $response = Http::get('http://localhost:3000/api/v1/aspiration-addresses/' . $request->aspiration_address_id);

            if ($response->successful()) {
                $aspirationAddress = $response->json()['data'];

                return view('admin.aspirationaddress.edit', [
                    'aspirationAddress' => $aspirationAddress
                ]);
            } else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function update_aspiration_address(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->patch('http://localhost:3000/api/v1/aspiration-addresses/' . $request->aspiration_address_id, [
                'aspiration_address' => $request->aspirationaddress

            ]);

            if ($response->successful()) {
                return redirect('/aspiration-address');
            }else {
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

        public function delete_aspiration_address(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->delete('http://localhost:3000/api/v1/aspiration-addresses/' . $request->aspiration_address_id);

            if ($response->successful()) {
                return redirect(url('/aspiration-address'));
            }else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }


}

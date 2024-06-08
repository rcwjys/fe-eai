<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;




class AspirationController extends Controller
{
    public function send_request(String $method, String $url, Bool $header, array $data = [])
    {
        try {
            if ($header) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer '. Session::get('_access_token'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])->$method($url, $data);


            } else {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])->$method($url, $data);

            }

            return $response;
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function get_all_aspiration(Request $request)
    {

        $response = $this->send_request('get','http://localhost:3000/api/v1/aspiration', true);

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspiration = $this->getAspiration($response);
            return view('admin.aspiration.index', [
                'aspiration' => $aspiration,
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

    public function get_detail_aspiration(Request $request)
    {
        try {

            $response = $this->send_request('get', 'http://localhost:3000/api/v1/aspiration/' . $request->aspiration_id, true);

            if ($response->successful()) {
                $data = $response->json();
                $aspiration = $data['data'];

                $userResponse = $this->send_request('get', 'http://localhost:3000/api/v1/userId/' . $aspiration['user_id'], true);
                if ($userResponse->successful()) {
                    $user = $userResponse->json()["data"];
                    $aspiration['username'] = $user['username'];
                } else {
                    $aspiration['username'] = 'Unknown User';
                }

                $addressResponse = $this->send_request('get', 'http://localhost:3000/api/v1/aspiration-addresses/' . $aspiration['aspiration_address_id'], true);
                if ($addressResponse->successful()) {
                    $address = $addressResponse->json()["data"];
                    $aspiration['aspiration_address'] = $address['aspiration_address'];
                } else {
                    $aspiration['aspiration_address'] = 'Unknown Address';
                }

                return view('admin.aspiration.detail', ['aspiration' => $aspiration]);
            } else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }


    public function show_create_aspiration_form()
    {
        $response = Http::get('http://localhost:3000/api/v1/aspiration-addresses');

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspirationAddresses = $this->getAspirationAddresses($response);
            return view('admin.aspiration.create', [
                'aspirationAddresses' => $aspirationAddresses,
            ]);
        } else {
            return view('admin.aspiration.create', [
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

    public function store_aspiration_data(Request $request)
    {
        try {
            $response = $this->send_request('post', 'http://localhost:3000/api/v1/aspiration/create', true, [
                'user_id' => Session::get('_user_id'),
                'aspiration_address_id' => $request->aspiration_address_id,
                'aspiration' => $request->aspiration
            ]);
            if ($response->successful()) {
                return redirect(url('/aspiration'));
            } else {
                dd($response->json());
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }


    public function show_aspiration_edit_form(Request $request)
    {
        $aspirationResponse = $this->send_request('get', 'http://localhost:3000/api/v1/aspiration/' . $request->aspiration_id, true);
        $addressesResponse = $this->send_request('get','http://localhost:3000/api/v1/aspiration-addresses?aspiration_id=' . $request->aspiration_id, true);

        if ($aspirationResponse->successful() && $addressesResponse->successful()) {
            $aspiration = $this->getAspirationData($aspirationResponse);
            $aspirationAddresses = $this->getAspirationAddresses($addressesResponse);
            $statusLabels = config('aspiration.Status');

        // dd($aspiration, $aspirationAddresses, $statusLabels);
        return view('admin.aspiration.edit', [
            'aspiration' => $aspiration,
            'aspirationAddresses' => $aspirationAddresses,
            'statusLabels' => $statusLabels,
        ]);
    } else {
        return view('admin.aspiration.edit', [
            'aspiration' => null,
            'aspirationAddresses' => [],
            'statusLabels' => config('aspiration.status'),
        ]);
        }

    }

    private function getAspirationData($response)
    {
        $data = $response->json();

        if (isset($data['data'])) {
            return $data['data'];
        }

        return null;
    }



    public function update_aspiration(Request $request)
{
    try {

        $response = $this->send_request('patch', 'http://localhost:3000/api/v1/aspiration/' . $request->aspiration_id, true, [
            'user_id' => Session::get('_user_id'),
            'aspiration' => $request->aspiration,
            'aspiration_status' => $request->aspiration_status,
            'aspiration_address_id' => $request->aspiration_address_id,
        ]);

        if ($response->successful()) {
            return redirect('/aspiration')->with('success', 'Aspiration updated successfully');
        } else {
            return back()->withErrors(['msg' => 'Failed to update aspiration']);
        }
    } catch (\Throwable $e) {
        return back()->withErrors(['msg' => $e->getMessage()]);
    }
}


    public function delete_aspiration(Request $request)
    {
        try {
            $response = $this->send_request('delete', 'http://localhost:3000/api/v1/aspiration/' . $request->aspiration_id, true);

            if ($response->successful()) {

                return redirect(url('/aspiration'));

            } else {
                dd($response->json());
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }



}

?>

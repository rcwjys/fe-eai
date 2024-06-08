<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserAspirationController extends Controller
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
        $user_id = Session::get('_user_id'); // Mengambil user ID dari sesi dengan kunci yang benar

    // Log user ID untuk debugging
    Log::info('User ID from session: ' . $user_id);

    if (!$user_id) {
        // Jika user_id tidak ada dalam sesi, berikan pesan error atau redirect
        Log::error('User ID tidak ditemukan dalam sesi.');
        return redirect()->route('login')->withErrors('User ID tidak ditemukan dalam sesi.');
    }

    // Perbarui URL endpoint API dengan format yang benar
    $response = $this->send_request('get', 'http://localhost:3000/api/v1/aspiration/userId/' . $user_id, true);

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspiration = $this->getAspiration($response);
            return view('user.aspiration.index', [
                'aspiration' => $aspiration,
            ]);
        } else {
            return view('user.aspiration.index', [
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

                return view('user.aspiration.detail', ['aspiration' => $aspiration]);
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
            return view('user.aspiration.create', [
                'aspirationAddresses' => $aspirationAddresses,
            ]);
        } else {
            return view('user.aspiration.create', [
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
                return redirect(url('/user/aspiration'));
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

        // dd($aspiration, $aspirationAddresses, $statusLabels);
        return view('user.aspiration.edit', [
            'aspiration' => $aspiration,
            'aspirationAddresses' => $aspirationAddresses,
        ]);
    } else {
        return view('user.aspiration.edit', [
            'aspiration' => null,
            'aspirationAddresses' => [],
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
            $response = $this->send_request('patch', 'http://localhost:3000/api/v1/aspiration/'. $request->aspiration_id, true, [
                'user_id' => Session::get('_user_id'),
                'aspiration_address_id' => $request->aspiration_address_id,
                'aspiration' => $request->aspiration

            ]);

            if ($response->successful()) {
                return redirect('/user/aspiration')->with('success', 'Aspiration updated successfully');
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
                return redirect(url('/user/aspiration'));
            } else {
                dd($response->json());
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }


    public function show_aspiration_edit_status_form(Request $request)
    {
        $response = Http::get('get', 'http://localhost:3000/api/v1/aspiration/'. $request->aspiration_id, true);

        Log::info('API Response: ' . $response->body());

        if ($response->successful()) {
            $aspirationAddresses = $this->getAspirationAddresses($response);
            return view('user.aspiration.editstatus', [
                'aspiration' => $aspirationAddresses,
            ]);
        } else {
            return view('user.aspiration.editstatus', [
                'aspiration' => [],
            ]);
        }
    }

    public function update_status_aspiration(Request $request)
    {
        try {
            $response = $this->send_request('patch', 'http://localhost:3000/api/v1/aspiration/status/'. $request->aspiration_id, true, [
                'user_id' => Session::get('_user_id'),
                'aspiration_address_id' => $request->aspiration_address_id,
                'aspiration' => $request->aspiration

            ]);

            if ($response->successful()) {
                return redirect('/aspiration');
            }else {
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }










}

?>

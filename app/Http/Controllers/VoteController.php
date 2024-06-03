<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class VoteController extends Controller
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

    public function get_all_vote()
    {
        try {
            // $response = $this->send_request('get', 'http://localhost:3000/api/v1/votes', true);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->get('http://localhost:3000/api/v1/votes');

            dd($response->headers());

            if ($response->successful()) {

                $votes_data = $response->json();

                return view('Admin.votes', [
                    'votes' => $votes_data["data"]
                ]);
            } else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

}

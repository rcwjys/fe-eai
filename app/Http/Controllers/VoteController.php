<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

    public function get_all_vote(Request $request)
    {
        try {
            $response = $this->send_request('get', 'http://localhost:3000/api/v1/votes', true);

            if ($response->successful()) {

                $votes_data = $response->json();
                return view('Admin.Votes.votes', [
                    'votes' => $votes_data["data"]["votes"]
                ]);
            } else {

                dd($response->json());
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function get_detail_votes(Request $request)
    {
        try {
            $response = $this->send_request('get', 'http://localhost:3000/api/v1/votes/'. $request->vote_id, true);

            if ($response->successful()) {
                $data = $response->json();
                return view('Admin.Votes.detail-votes', ['vote' => $data["data"]]);

                if (Session::get('is_admin') === true)
                    return view('Admin.Votes.votes', [
                        'vote' => $data['data']

                ]);
                    if (Session::get('isAuthorize') === true)
                        return view('User.Votes.votes', [
                            'vote' => $data['data']
                        
                ]);
            } else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function show_create_form() 
    {  try {
        $response = Http::get('http://localhost:3000/api/v1/candidates');

        if ($response->successful()) {
            $candidates_data = $response->json();

            if (Session::get('is_admin') === true)
            return view('Admin.Votes.create-votes', [
                'candidates' => $candidates_data['data']

        ]);
            if (Session::get('is_admin') === False)
                return view('User.Votes.create-votes', [
                    'candidates' => $candidates_data['data']
                
        ]);
        
        }else {
            return back();
        }
    } catch (\Throwable $e) {
        dd($e->getMessage());
    }
      
    }

    public function store_vote_data(Request $request)
    {
        try {
            $response = $this->send_request('post', 'http://localhost:3000/api/v1/votes', true, [
                'user_id' => Session::get('_user_id'),
                'candidate_id' => $request->candidate_id
            ]);
            if ($response->successful()) {
                

                if (Session::get('is_admin') === true) {
                    return redirect(url('/admin/dashboard'));
                }

                else {
                    return redirect(url('/user/dashboard'));
                }
            } else {
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function delete_vote_data(Request $request)
    {
        try {
            $response = $this->send_request('delete', 'http://localhost:3000/api/v1/votes/' . $request->vote_id, true);

            if ($response->successful()) {
                return redirect(url('/votes'));
            } else {
                dd($response->json());
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}

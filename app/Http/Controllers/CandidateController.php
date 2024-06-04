<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Throwable;

class CandidateController extends Controller
{
    public function get_all_candidate()
    {
        try {
            $response = Http::get('http://localhost:3000/api/v1/candidates');

            if ($response->successful()) {
                $candidates_data = $response->json();

                return view('User.Candidates.candidates', [
                    'candidates' => $candidates_data['data']
                ]);
            }else {
                return back();
            }
        } catch (\Throwable $e) {
        }
    }


    public function get_details_candidate(Request $request)
    {
        try {
            $response = Http::get('http://localhost:3000/api/v1/candidates/' . $request->candidate_slug);

            if ($response->successful()) {

                $candidate_data = $response->json();

                return view('Admin.Candidates.detail-candidate', [
                    'candidate' => $candidate_data['data']['candidate']
                ]);
            }else {
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }


    public function show_create_candidate_form()
    {
        return view('User.Candidates.create-candidate');
    }

    public function store_candidate_data(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->post('http://localhost:3000/api/v1/candidates', [
                'candidate_name' => $request->candidate_name,
                'candidate_biography' => $request->candidate_biography,
                'candidate_vision' => $request->candidate_vision,
                'candidate_mission' => $request->candidate_mission
            ]);

            if ($response->successful()) {
                return back();
            } else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function show_candidate_edit_form(Request $request)
    {
       try {
        $response = Http::get('http://localhost:3000/api/v1/candidates/' . $request->candidate_slug);

        if ($response->successful()) {

            $candidate_data = $response->json();

            return view('User.Candidates.update-candidate', [
                'candidate' => $candidate_data['data']['candidate']
            ]);
        }else {
            return back();
        }

       } catch (\Throwable $e) {
            dd($e->getMessage());
       }
    }

    public function update_candidate(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->patch('http://localhost:3000/api/v1/candidates/' . $request->candidate_id, [
                "candidate_name" => $request->candidate_name,
                "candidate_biography" => $request->candidate_biography,
                "candidate_vision" => $request->candidate_vision,
                "candidate_mission" => $request->candidate_mission

            ]);

            if ($response->successful()) {
                return redirect(url('/candidates'));
            }else {
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function delete_candidate(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. Session::get('_access_token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->delete('http://localhost:3000/api/v1/candidates/' . $request->candidate_id);

            if ($response->successful()) {
                return redirect(url('/candidates'));
            }else {
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}

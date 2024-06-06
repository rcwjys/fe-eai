@extends('Admin.Template.main')
@section('title', 'Detail Candidate')
@section('content')

<div class="container">
  <div class="container mt-5">
    <h2 class="mb-4">Calon Kandidat</h2>
    <div class="row">

      <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$candidate["candidate_name"]}}</h5>
                <p class="card-text ">Biography</p>
                <p class="card-text">{{$candidate["candidate_biography"]}}</p>
                <br>
                <p class="card-text ">Mission</p>
                <p class="card-text">{{$candidate["candidate_mission"]}}</p>
                <br>
                <p class="card-text ">Vision</p>
                <p class="card-text">{{$candidate["candidate_vision"]}}</p>
              <a href="{{url('/candidates')}}">Kembali</a>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

@endsection
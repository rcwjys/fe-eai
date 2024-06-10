@extends('Admin.Template.main')
@section('title', 'Candidate')
@section('content')

<div class="container">
  <div class="container mt-5">
    <h2 class="mb-4">Calon Kandidat</h2>
    <div class="row">

      @foreach ($candidates as $candidate)
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
              
                <br>
                <p class="card-text ">Total Voting</p>
                <p class="card-text">{{$candidate["candidate_vote_total"]}}</p>

              <a class="ml-1" href="{{url('/candidates/'. $candidate["candidate_slug"])}}">Detail </a>

              @if (Session::get('is_admin') === true)
              <a href="{{url('/edit-candidate/' . $candidate["candidate_slug"])}}">Update Kandidat</a>

              <form action="{{url('/candidate/'.$candidate["candidate_id"].'/delete')}}" method="POST" >
                @csrf
                @method('DELETE')
              <button type="submit">Delete</button>
              </form>
              @endif

            </div>
        </div>
    </div>
      @endforeach
    </div>
</div>
</div>

@endsection
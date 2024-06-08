@extends('Admin.Template.main')
@section('title', 'Votes')
@section('content')


<div class="container mt-3">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Vote id</th>
        <th scope="col">Voter id</th>
        <th scope="col">Candidate id</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$vote["vote"]["vote_id"]}}</td>
        <td>{{$vote["vote"]["voter_id"]}}</td>
        <td>{{$vote["vote"]["candidate_id"]}}</td>
        <td>{{$vote["vote"]["created_at"]}}</td>
        <td><a href="{{url('/votes')}}">back</a></td>
      </tr>
  
    </tbody>
  </table>
</div>

@endsection
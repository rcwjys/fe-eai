@extends('User.Template.main')
@section('title', 'Votes')
@section('content')
{{-- 
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Voter Name</th>
      <th scope="col">Candidate Name</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($votes as $vote)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$votes["voter_name"]}}</td>
      <td>{{$votes["candidate_id"]}}</td>
      <td>{{$votes["created_at"]}}</td>
    </tr>
    @endforeach

  </tbody>
</table> --}}

<h1>helo</h1>
@endsection
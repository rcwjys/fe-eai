@extends('User.Template.main')
@section('title', 'Votes')
@section('content')

<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Voter id</th>
        <th scope="col">Candidate id</th>
        <th scope="col">Created At</th>
        <th scope="col">Detal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($votes as $index => $vote)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$vote["voter_id"]}}</td>
        <td>{{$vote["candidate_id"]}}</td>
        <td>{{$vote["created_at"]}}</td>
        <td><a href="{{url('/votes/'. $vote["vote_id"])}}">Detail</a></td>
        <td>
          <form action="{{url('/votes/delete/'.$vote["vote_id"])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
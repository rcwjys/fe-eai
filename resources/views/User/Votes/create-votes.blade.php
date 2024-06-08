@extends('User.Template.main')
@section('title', 'Votes')
@section('content')

<div class="container">
  <form action="{{url('/create-votes')}}" method="POST">
    @csrf
    <label for="candidate">Pilih</label>
    <select name="candidate_id" id="candidate">
      @foreach ($candidates as $candidate)
      <option value="{{$candidate["candidate_id"]}}">{{$candidate["candidate_name"]}}</option>
      @endforeach
    </select>
    <button type="submit">Submit</button>
  </form>
</div>

@endsection
@extends('Admin.Template.main')
@section('title', 'Update Candidate')
@section('content')

<div class="container mt-5">
  <h2>Edit Candidate Information Form</h2>
  <form id="candidateForm" action="{{url('/edit-candidate/' . $candidate["candidate_id"])}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
          <label for="candidate_name">Candidate Name</label>
          <input type="text" class="form-control" id="candidate_name" name="candidate_name" value="{{ $candidate["candidate_name"] }}" placeholder="Enter candidate name" required>
      </div>
      <div class="form-group">
          <label for="candidate_biography">Biography</label>
          <input type="text" class="form-control" id="candidate_biography" name="candidate_biography" value="{{ $candidate["candidate_biography"] }}" required></input>
      </div>
      <div class="form-group">
          <label for="candidate_vision">Vision</label>
          <input type="text" class="form-control" id="candidate_vision" name="candidate_vision" value="{{ $candidate["candidate_vision"] }}"  required></input>
      </div>
      <div class="form-group">
          <label for="candidate_mission">Mission</label>
          <input type="text" class="form-control" id="candidate_mission" name="candidate_mission" value="{{ $candidate["candidate_mission"] }}" required></input>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
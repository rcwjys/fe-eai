@extends('Admin.Template.main')
@section('title', 'Create Candidate')
@section('content')
<div class="container mt-5">
  <h2>Candidate Information Form</h2>
  <form id="candidateForm" action="{{url('/candidate')}}" method="POST">
    @csrf
      <div class="form-group">
          <label for="candidate_name">Candidate Name</label>
          <input type="text" class="form-control" id="candidate_name" name="candidate_name" placeholder="Enter candidate name" required>
      </div>
      <div class="form-group">
          <label for="candidate_biography">Biography</label>
          <textarea class="form-control" id="candidate_biography" name="candidate_biography" rows="3" placeholder="Enter candidate biography" required></textarea>
      </div>
      <div class="form-group">
          <label for="candidate_vision">Vision</label>
          <textarea class="form-control" id="candidate_vision" name="candidate_vision" rows="3" placeholder="Enter candidate vision" required></textarea>
      </div>
      <div class="form-group">
          <label for="candidate_mission">Mission</label>
          <textarea class="form-control" id="candidate_mission" name="candidate_mission" rows="3" placeholder="Enter candidate mission" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
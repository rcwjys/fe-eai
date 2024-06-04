@extends('Admin.Template.main')
@section('title', 'Aspiration Address')
@section('content')

<div class="container">
  <div class="container mt-5">
    <h2 class="mb-4">Daftar Tujuan Aspirasi</h2>
    <div class="row">

      {{-- @foreach ($aspiration_address as $address)
      <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$address["aspiration_address"]}}</h5> --}}

              {{-- @if (Session::get('is_admin') === true)
              <a href="{{url('/edit-candidate/' . $candidate["candidate_slug"])}}">Update Kandidat</a>

              <form action="{{url('/candidate/'.$candidate["candidate_id"].'/delete')}}" method="POST" >
                @csrf
                @method('DELETE')
              <button type="submit">Delete</button>
              </form>
              @endif --}}

            </div>
        </div>
    </div>
      {{-- @endforeach --}}
    </div>
</div>
</div>

@endsection

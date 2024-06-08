@extends('User.Template.main')
@section('title', 'Aspiration')
@section('content')

<div class="container">
  <div class="container mt-5">
    <h2 class="mb-4">Daftar Aspirasi</h2>
    <div class="row">

      @foreach ($aspiration as $aspirations)
      <div class="col-md-6 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center">
                    <h5 class="card-title me-4">{{ $loop->iteration }}.</h5>
                    <h5 class="card-title">{{ $aspirations["aspiration"] }}</h5>
                </div>
                <h6 class="card-title">Status : {{ $aspirations["aspiration_status"] }}</h6>
                <h6 class="card-title">Nama User   : {{ $aspirations["user_id"] }}</h6>
                <h6 class="card-title">Tujuan : {{ $aspirations["aspiration_address_id"] }}</h6>

                <a href="{{url('/detail/aspiration/' . $aspirations["aspiration_id"])}}" class="btn btn-info">Detail</a>

                <div class="d-flex justify-content-start align-items-center">
                    

              {{-- @if (Session::get('is_admin') === true)
              <a href="{{url('/edit-aspiration-address/' . $address["aspiration_address_id"])}}" class="btn btn-warning">Edit Tujuan Aspirasi</a>


              <form action="{{url('/aspiration-address/'.$address["aspiration_address_id"].'/delete')}}" method="POST" >
                @csrf
                @method('DELETE')
              <button class="mt-2 btn btn-danger" type="submit">Delete</button>
              </form>
              @endif --}}


            </div>
        </div>
    </div>
    </div>
      @endforeach

    </div>
    <a href="/aspiration/create" class="btn btn-primary mt-4 ml-8 w-25">Tambah Aspirasi</a>

</div>
</div>

@endsection

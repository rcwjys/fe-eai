@extends('Admin.Template.main')
@section('title', 'Aspiration Address')
@section('content')

<div class="container">
  <div class="container mt-5">
    <h2 class="mb-4">Daftar Tujuan Aspirasi</h2>
    <div class="row">

      {{-- @foreach ($aspirationAddresses as $address) --}}
      <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                

                {{-- <h4 class="card-title mb-4">{{$address["aspiration_address"]}}</h4>
                <div class="d-flex justify-content-between align-items-center">
              @if (Session::get('is_admin') === true)
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
      {{-- @endforeach --}}

    </div>
    <a href="/create-aspiration-address" class="btn btn-primary mt-4 ml-8 w-25">Tambah Tujuan Aspirasi</a>

</div>
</div>

@endsection

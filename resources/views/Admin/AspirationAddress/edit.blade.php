@extends('Admin.Template.main')
@section('title', 'Edit Tujuan Aspirasi')
@section('content')

<div class="container mt-3">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h2 class="mb-4">Edit Tujuan Aspirasi</h2>

      <div class="card card-sm w-75">
        <div class="card-body">
            <form method="POST" action="{{url('/edit-aspiration-address/'. $aspirationAddress["aspiration_address_id"])}}">
                @csrf
                @method('PATCH')
                <div class="input-group mb-6">
                    <span class="input-group-text">Tujuan Aspirasi</span>
                    <input type="text" class="form-control" name="aspirationaddress" aria-label="Tujuan Aspirasi" value="{{ $aspirationAddress['aspiration_address'] ?? '' }}" />
                </div>

                <input class="btn btn-primary mt-4" type="submit" value="Submit">
            </form>
        </div>
    </div>



    </div>
  </div>
</div>


@endsection

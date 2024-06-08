@extends('Admin.Template.main')
@section('title', 'Tambah Tujuan Aspirasi')
@section('content')

<div class="container mt-3">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h2 class="mb-4">Masukan Tujuan Aspirasi Baru</h2>

      <div class="card card-sm w-75">
        <div class="card-body">
            <form method="POST" action="{{url('/store-aspiration-address')}}">
                @csrf
                <div class="input-group mb-6">
                    <span class="input-group-text">Tujuan Aspirasi</span>
                    <input type="text" class="form-control" name="aspirationaddress" aria-label="Tujuan Aspirasi" />
                </div>

                <input class="btn btn-primary mt-4" type="submit" value="Submit">
            </form>
        </div>
    </div>



    </div>
  </div>
</div>


@endsection

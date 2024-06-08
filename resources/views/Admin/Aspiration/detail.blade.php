@extends('Admin.Template.main')
@section('title', 'Aspiration Detail')
@section('content')

<div class="container">
  <div class="container mt-5">
    <h2 class="mb-4">Detail Aspirasi Aspirasi</h2>
    <div class="row">


      <div class="col-md-6 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center">
                    <h5 class="card-title">{{$aspiration["aspiration"]}}</h5>
                </div>

                <h6 class="card-title">Nama User   : {{$aspiration["user_id"]}}</h6>
                <h6 class="card-title">Tujuan : {{$aspiration["aspiration_address_id"]}}</h6>
                <h6 class="card-title">Status : {{$aspiration["aspiration_status"]}}</h6>

                <div class="d-flex justify-content-between align-items-center mt-4">

              @if (Session::get('is_admin') === true)
              <a href="{{url('/edit-aspiration/' . $aspiration["aspiration_id"])}}" class="btn btn-success">Verifikasi Status Aspirasi</a>

              <a href="{{url('/edit-aspiration/' . $aspiration["aspiration_id"])}}" class="btn btn-warning">Edit Aspirasi</a>


              <form action="{{url('/aspiration/'.$aspiration["aspiration_id"].'/delete')}}" method="POST" >
                @csrf
                @method('DELETE')
              <button class="mt-2 btn btn-danger" type="submit">Delete</button>
              </form>
              @endif


            </div>
        </div>
    </div>
    </div>


    </div>


</div>
</div>

@endsection

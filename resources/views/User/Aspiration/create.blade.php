@extends('User.Template.main')
@section('title', 'User Dashboard')
@section('content')

<div class="container mt-3">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">

      <h2 class="display-4 mb-4">Halo Mahasiswa Sistem Informasi</h2>

      <div class="card card-sm w-75 mt-2">
        <div class="card-body">
            <p class="lead">Ayo berikan aspirasi terbaik kalian untuk memajukan jurusan tercinta kita ini</p>

            <form method="POST" action="/store-aspiration">
                @csrf
                <div class="form-floating mb-4">
                    <select class="form-select" id="floatingSelect" name="aspiration_address_id" aria-label="Floating label select example">
                        <option selected disabled>Tujuan Aspirasi</option>
                        @if (isset($aspirationAddresses) && is_array($aspirationAddresses) && count($aspirationAddresses) > 0)
                            @foreach ($aspirationAddresses as $address)
                                <option value="{{ $address['aspiration_address_id'] }}">{{ $address['aspiration_address'] }}</option>
                            @endforeach
                        @else
                            <option disabled>No aspiration addresses available</option>
                        @endif
                    </select>
                    <label for="floatingSelect">Tujuan Aspirasi</label>
                </div>

                <div class="input-group mb-6">
                    <span class="input-group-text">Aspirasi</span>
                    <textarea class="form-control" name="aspiration" aria-label="With textarea"></textarea>
                </div>

                <input class="btn btn-primary mt-4" type="submit" value="Submit">
            </form>
        </div>
    </div>



    </div>
  </div>
</div>


@endsection

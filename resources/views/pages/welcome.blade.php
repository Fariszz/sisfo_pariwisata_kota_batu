@extends('layouts.main')

@section('content')
<div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="/storage/images/logo-kota-batu-new.png" alt="" width="30%" height="30%">
    {{-- <h1 class="display-5 fw-bold">Kota Batu</h1> --}}
    <div class="col-lg-6 mx-auto mt-5">
        <p class="lead mb-4">Kota Batu adalah sebuah kota di Provinsi Jawa Timur, Indonesia. Kota ini terletak 90 km sebelah barat daya Surabaya atau 15 km sebelah barat laut Malang. Kota Batu berada di jalur yang menghubungkan Malang-Kediri dan Malang-Jombang</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a type="button" href="{{ route('google.map.index') }}" class="btn btn-primary btn-lg px-4 gap-3">Gas</a>
    </div>
    </div>
</div>

<!-- Akhir Konten -->
@endsection

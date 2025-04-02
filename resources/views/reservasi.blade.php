@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Reservasi Meja</h1>
    <p class="text-center">Silakan pilih meja yang tersedia dan isi formulir berikut untuk melakukan reservasi.</p>
    
    <div class="row">
        @foreach ($meja as $m)
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg">
                <img src="{{ asset('storage/' . $m->gambar) }}" class="card-img-top" alt="Meja {{ $m->nama }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $m->nama }}</h5>
                    <p class="card-text">Kapasitas: {{ $m->kapasitas }} orang</p>
                    <form action="{{ route('reservasi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="meja_id" value="{{ $m->id }}">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">  
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" class="form-control" id="waktu" name="waktu" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                            <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reservasi Meja Ini</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
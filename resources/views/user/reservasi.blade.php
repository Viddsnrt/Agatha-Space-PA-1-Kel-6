@extends('user.layouts.app')


@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Pilih Meja untuk Reservasi</h4>

    <div class="row">
        @foreach($tables as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="Gambar Meja">
                @endif
                <div class="card-body">
                    <h5 class="card-title">Meja: {{ $item->meja }}</h5>
                    <!-- <p class="card-text">{{ $item->catatan ?? 'Tidak ada keterangan' }}</p> -->
                    <button 
                        class="btn btn-primary w-100"
                        onclick="isiForm('{{ $item->meja }}')"
                    >
                        Reservasi
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Form Reservasi --}}
    <div class="card mt-5" id="formReservasi" style="display: none;">
        <div class="card-body">
            <h4 class="mb-3">Form Reservasi Meja: <span id="mejaTerpilihText"></span></h4>

            <form action="{{ route('reservasi.kirim') }}" method="POST">
                @csrf
                <input type="hidden" name="meja" id="mejaTerpilih">

                <div class="mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Reservasi</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam</label>
                    <input type="time" name="jam" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (jam)</label>
                    <input type="number" name="durasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Kirim via WhatsApp</button>
            </form>
        </div>
    </div>
</div>

<script>
    function isiForm(meja) {
        document.getElementById('formReservasi').style.display = 'block';
        document.getElementById('mejaTerpilih').value = meja;
        document.getElementById('mejaTerpilihText').innerText = meja;

        // Scroll ke form
        document.getElementById('formReservasi').scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection

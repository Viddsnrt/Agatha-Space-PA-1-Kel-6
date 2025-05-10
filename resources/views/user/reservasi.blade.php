@extends('user.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center"><i class="fas fa-chair text-primary me-2"></i> Pilih Meja untuk Reservasi</h2>

    <div class="row">
        @forelse($tables as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top rounded-top" alt="Gambar Meja">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">Meja: <strong>{{ $item->meja }}</strong></h5>
                        <button class="btn btn-outline-primary mt-2 w-100" onclick="isiForm('{{ $item->meja }}')">
                            <i class="fas fa-calendar-check me-1"></i> Reservasi Meja Ini
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada data meja.</p>
        @endforelse
    </div>

    {{-- Form Reservasi --}}
    <div class="collapse mt-5" id="formReservasi">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="mb-4"><i class="fas fa-clipboard-list text-success me-2"></i> Form Reservasi Meja: <span id="mejaTerpilihText" class="text-primary"></span></h4>

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

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fab fa-whatsapp me-1"></i> Kirim via WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function isiForm(meja) {
        const form = document.getElementById('formReservasi');
        document.getElementById('mejaTerpilih').value = meja;
        document.getElementById('mejaTerpilihText').innerText = meja;
        
        const bsCollapse = new bootstrap.Collapse(form, {
            toggle: true
        });

        // Scroll ke form
        setTimeout(() => {
            form.scrollIntoView({ behavior: 'smooth' });
        }, 300);
    }
</script>
@endpush
@endsection

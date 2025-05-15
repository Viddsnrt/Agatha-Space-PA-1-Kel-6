{{-- resources/views/user/kritik_saran/index.blade.php --}}
@extends('user.layouts.app')

@section('title', 'Kritik & Saran - Agatha Space')

@push('styles')
{{-- ... (styles Anda tetap sama) ... --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    body { background-color: #fdfaf7; }
    .playfair-font { font-family: 'Playfair Display', serif; }
    .poppins-font { font-family: 'Poppins', sans-serif; }
    .kritik-saran-page { padding-top: 20px; padding-bottom: 60px; }
    .page-header { text-align: center; margin-bottom: 40px; }
    .page-header .page-title { font-family: 'Playfair Display', serif; color: #4a2f27; font-size: 2.8rem; font-weight: 700; margin-bottom: 0.5rem; }
    .page-header .page-subtitle { font-family: 'Poppins', sans-serif; color: #6c757d; font-size: 1.1rem; margin-bottom: 1.5rem; }
    .btn-toggle-form { background-color: #ED5D2B; border-color: #ED5D2B; color: white; padding: 12px 28px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.05rem; border-radius: 50px; transition: background-color 0.3s ease, transform 0.2s ease; }
    .btn-toggle-form:hover { background-color: #d45020; color: white; transform: translateY(-2px); }
    .btn-toggle-form i { margin-right: 8px; }
    .form-kritik-saran-wrapper { background-color: #ffffff; padding: 30px 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); margin-bottom: 50px; border: 1px solid #eee; }
    .form-kritik-saran-wrapper .form-title { font-family: 'Playfair Display', serif; color: #4a2f27; font-size: 2rem; margin-bottom: 20px; text-align: center; }
    .form-label { font-family: 'Poppins', sans-serif; font-weight: 500; color: #555; margin-bottom: 0.5rem; }
    .form-control, .form-select { font-family: 'Poppins', sans-serif; border-radius: 8px; border: 1px solid #ced4da; padding: 0.75rem 1rem; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; }
    .form-control:focus, .form-select:focus { border-color: #a8745f; box-shadow: 0 0 0 0.2rem rgba(168, 116, 95, 0.2); }
    .form-select.placeholder-style { color: #6c757d; }
    .form-select.placeholder-style option:first-child { display: none; }
    .btn-submit-kritik { background-color: #6c4f3d; border-color: #6c4f3d; color: white; padding: 12px 25px; font-size: 1.1rem; font-family: 'Poppins', sans-serif; font-weight: 500; border-radius: 8px; }
    .btn-submit-kritik:hover { background-color: #4a2f27; border-color: #4a2f27; color: white; }
    .btn-submit-kritik i { margin-right: 8px; }
    .feedback-list-section { }
    .feedback-card { background-color: #fff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; height: 100%; display: flex; flex-direction: column; padding: 20px; transition: box-shadow 0.3s ease; }
    .feedback-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
    .feedback-card .card-header-info { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
    .feedback-card .user-info .card-title { font-family: 'Playfair Display', serif; color: #4a2f27; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.1rem; }
    .feedback-card .user-info .text-muted { font-family: 'Poppins', sans-serif; font-size: 0.8rem; color: #888; }
    .feedback-card .badge { font-family: 'Poppins', sans-serif; font-size: 0.75rem; padding: 0.4em 0.9em; border-radius: 50px; font-weight: 500; }
    .badge.bg-kritik { background-color: #dc3545; color: white; }
    .badge.bg-saran { background-color: #28a745; color: white; }
    .feedback-card .pesan-text { font-family: 'Poppins', sans-serif; color: #555; font-size: 0.95rem; line-height: 1.6; margin-top: 8px; margin-bottom: 15px; flex-grow: 1; }
    .feedback-card .gambar-link { font-family: 'Poppins', sans-serif; font-size: 0.9rem; color: #0d6efd; text-decoration: none; font-weight: 500; }
    .feedback-card .gambar-link:hover { text-decoration: underline; }
    .no-feedback-message { text-align: center; padding: 40px 0; }
    .no-feedback-message i { font-size: 3rem; color: #ccc; margin-bottom: 1rem; }
    .no-feedback-message p { font-family: 'Poppins', sans-serif; color: #777; }
    .alert { font-family: 'Poppins', sans-serif; border-radius: 8px; }
    .alert-success { background-color: #e6f7ec; color: #1e6a39; border: 1px solid #b7e4c7; }
    .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    .alert-danger ul { margin-bottom: 0; padding-left: 20px; }
    .pagination .page-link { font-family: 'Poppins', sans-serif; color: #6c4f3d; border-radius: 0.3rem; margin: 0 3px; }
    .pagination .page-link:hover { color: #4a2f27; background-color: #f8f5f2; }
    .pagination .page-item.active .page-link { background-color: #a8745f; border-color: #a8745f; color: white; }
    .modal-body.p-0 img { display: block; margin: 0 auto; }
    .modal-content { border-radius: 10px; }
</style>
@endpush

@section('content')
<div class="kritik-saran-page container">
    <div class="page-header" data-aos="fade-up">
        <h1 class="page-title">Apa Kata Mereka?</h1>
        <p class="page-subtitle">Lihat masukan berharga dari para pengunjung Agatha Space.</p>
        @auth
        <button class="btn btn-toggle-form" id="btnToggleForm" data-aos="zoom-in" data-aos-offset="0">
            <i class="fas fa-plus-circle"></i> Beri Masukan Baru
        </button>
        @else
        <p class="mt-3 poppins-font" data-aos="fade-up" data-aos-delay="100">Ingin memberi masukan? Silakan <a href="{{ route('login', ['redirect' => route('kritik-saran.list', ['show_form' => 'true'])]) }}">masuk</a> atau <a href="{{ route('register') }}">daftar</a> terlebih dahulu.</p>
        @endauth
    </div>

    {{-- === PINDAHKAN NOTIFIKASI SUKSES KE SINI (DI LUAR WRAPPER FORM) === --}}
    @if (session('success_submit'))
        <div class="alert alert-success text-center mb-4" role="alert" data-aos="fade-down">
            <i class="fas fa-check-circle me-2"></i> {{ session('success_submit') }}
        </div>
    @endif
    {{-- === AKHIR BLOK NOTIFIKASI SUKSES YANG DIPINDAHKAN === --}}

    {{-- Wrapper untuk Form (awalnya disembunyikan jika tidak ada error atau parameter show_form) --}}
    <div id="formKritikSaranWrapper"
         class="form-kritik-saran-wrapper {{ $showForm ? '' : 'd-none' }}"
         data-aos="fade-down"
    >
        <h3 class="form-title">Formulir Kritik & Saran</h3>

        {{-- Notifikasi sukses sudah dipindahkan KELUAR dari wrapper ini --}}

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h5 class="alert-heading fw-bold poppins-font"><i class="fas fa-exclamation-triangle me-2"></i>Oops! Ada beberapa kesalahan:</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kritik-saran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', auth()->user()?->name) }}" required placeholder="Nama Anda">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()?->email) }}" required placeholder="email@contoh.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="tel" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required placeholder="Isi dengan No telepon Anda">
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Masukan</label>
                <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                    <option value="" selected disabled>Pilih jenis</option>
                    <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                    <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
                </select>
                @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan Anda</label>
                <textarea name="pesan" id="pesan" rows="4" class="form-control @error('pesan') is-invalid @enderror" required placeholder="Tuliskan masukan Anda di sini...">{{ old('pesan') }}</textarea>
                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="gambar" class="form-label">Unggah Gambar (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/jpeg,image/png,image/gif">
                <small class="form-text text-muted mt-1 poppins-font">Maks. 5MB. Format: JPG, PNG, GIF.</small>
                @error('gambar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-submit-kritik"><i class="fas fa-paper-plane"></i> Kirim Masukan</button>
            </div>
        </form>
    </div>

    {{-- Daftar Kritik dan Saran --}}
    <div class="feedback-list-section">
        {{-- ... (konten daftar kritik saran Anda tetap sama) ... --}}
        <div class="row gy-4 justify-content-center">
            @forelse ($kritikSaran as $item)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="feedback-card w-100">
                        <div class="card-header-info">
                            <div class="user-info">
                                <h5 class="card-title">{{ Str::words($item->nama, 3, '...') }}</h5>
                                <p class="text-muted">{{ $item->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm') }}</p>
                            </div>
                            <span class="badge bg-{{ $item->jenis == 'kritik' ? 'kritik' : 'saran' }} flex-shrink-0">
                                <i class="fas {{ $item->jenis == 'kritik' ? 'fa-thumbs-down' : 'fa-thumbs-up' }} me-1"></i>
                                {{ ucfirst($item->jenis) }}
                            </span>
                        </div>
                        <p class="pesan-text fst-italic">"{{ Str::limit($item->pesan, 150) }}"</p>

                        @if ($item->gambar)
                            <a href="#" class="gambar-link mt-auto" data-bs-toggle="modal" data-bs-target="#imageModal-{{$item->id}}">
                                <i class="fas fa-paperclip me-1"></i> Gambar dari {{ Str::words($item->nama, 1, '') }}
                            </a>
                            <!-- Modal untuk Gambar -->
                            <div class="modal fade" id="imageModal-{{$item->id}}" tabindex="-1" aria-labelledby="imageModalLabel-{{$item->id}}" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body text-center p-0">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid" alt="Lampiran dari {{ $item->nama }}" style="max-height: 80vh;">
                                  </div>
                                </div>
                              </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12" data-aos="fade-up">
                    <div class="no-feedback-message">
                        <i class="fas fa-comment-slash"></i>
                        <p>Belum ada kritik atau saran yang dapat ditampilkan.</p>
                        @auth
                        <p>Jadilah yang pertama memberi masukan!</p>
                        @endauth
                    </div>
                </div>
            @endforelse
        </div>

        @if ($kritikSaran instanceof \Illuminate\Pagination\LengthAwarePaginator && $kritikSaran->hasPages())
            <div class="mt-5 pt-3 d-flex justify-content-center" data-aos="fade-up">
                {{ $kritikSaran->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnToggleForm = document.getElementById('btnToggleForm');
        const formWrapper = document.getElementById('formKritikSaranWrapper');
        const selectJenis = document.getElementById('jenis');

        const setSelectPlaceholderStyle = () => {
            if (selectJenis) {
                if (selectJenis.value === "" || selectJenis.value === null) {
                    selectJenis.classList.add('placeholder-style');
                } else {
                    selectJenis.classList.remove('placeholder-style');
                }
            }
        };
        setSelectPlaceholderStyle();
        if (selectJenis) {
            selectJenis.addEventListener('change', setSelectPlaceholderStyle);
        }

        if (btnToggleForm && formWrapper) {
            btnToggleForm.addEventListener('click', function () {
                const isHidden = formWrapper.classList.contains('d-none');
                if (isHidden) {
                    formWrapper.classList.remove('d-none');
                    setTimeout(() => {
                        formWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        if (typeof AOS !== 'undefined') AOS.refreshHard();
                    }, 50);
                } else {
                    formWrapper.classList.add('d-none');
                    if (typeof AOS !== 'undefined') AOS.refreshHard();
                }
            });
        }

        // Scroll ke form jika ada error validasi (form akan visible)
        // Atau scroll ke alert sukses jika ada (form akan hidden by default setelah sukses)
        const successAlert = document.querySelector('.alert.alert-success[role="alert"]'); // Lebih spesifik selectornya
        const errorAlert = document.querySelector('.alert.alert-danger[role="alert"]'); // Untuk error

        if (formWrapper && !formWrapper.classList.contains('d-none')) { // Form visible (kemungkinan karena error)
            const elementToScrollTo = errorAlert || formWrapper; // Prioritaskan scroll ke error alert jika ada
            setTimeout(() => {
                elementToScrollTo.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 250);
        } else if (successAlert) { // Form hidden, tapi ada alert sukses
             setTimeout(() => {
                successAlert.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' }); // 'center' atau 'start'
            }, 150); // Beri sedikit delay agar elemen ada di DOM dan AOS mungkin sudah init
        }


        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                once: true,
                offset: 50,
            });
        }
    });
</script>
@endpush
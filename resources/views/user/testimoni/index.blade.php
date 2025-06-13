{{-- resources/views/user/testimoni/index.blade.php --}}
@extends('user.layouts.app')

@section('title', 'Testimoni & Saran - Agatha Space')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Style Anda tetap sama, hanya pastikan nama class konsisten jika diubah */
    body { background-color: #fdfaf7; }
    .playfair-font { font-family: 'Playfair Display', serif; }
    .poppins-font { font-family: 'Poppins', sans-serif; }
    .testimoni-saran-page { padding-top: 20px; padding-bottom: 60px; } /* Mengganti nama class utama */
    .page-header { text-align: center; margin-bottom: 40px; }
    .page-header .page-title { font-family: 'Playfair Display', serif; color: #4a2f27; font-size: 2.8rem; font-weight: 700; margin-bottom: 0.5rem; }
    .page-header .page-subtitle { font-family: 'Poppins', sans-serif; color: #6c757d; font-size: 1.1rem; margin-bottom: 1.5rem; }
    .btn-toggle-form { background-color: #ED5D2B; border-color: #ED5D2B; color: white; padding: 12px 28px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.05rem; border-radius: 50px; transition: background-color 0.3s ease, transform 0.2s ease; }
    .btn-toggle-form:hover { background-color: #d45020; color: white; transform: translateY(-2px); }
    .btn-toggle-form i { margin-right: 8px; }
    .form-testimoni-saran-wrapper { background-color: #ffffff; padding: 30px 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); margin-bottom: 50px; border: 1px solid #eee; } /* Mengganti nama class wrapper form */
    .form-testimoni-saran-wrapper .form-title { font-family: 'Playfair Display', serif; color: #4a2f27; font-size: 2rem; margin-bottom: 20px; text-align: center; }
    .masukan-card { background-color: #fff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; height: 100%; display: flex; flex-direction: column; padding: 20px; transition: box-shadow 0.3s ease; }
    .masukan-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
    .masukan-card .badge { font-family: 'Poppins', sans-serif; font-size: 0.75rem; padding: 0.4em 0.9em; border-radius: 50px; font-weight: 500; }
    .badge.bg-testimoni { background-color: #198754; color: white; } /* Hijau untuk Testimoni */
    .badge.bg-saran { background-color: #0dcaf0; color: white; }    /* Biru muda untuk Saran */
    .badge.bg-kritik { background-color: #dc3545; color: white; }   /* Merah untuk Kritik (jika masih ada) */
    .no-masukan-message { text-align: center; padding: 40px 0; }
    .no-masukan-message i { font-size: 3rem; color: #ccc; margin-bottom: 1rem; }
    .no-masukan-message p { font-family: 'Poppins', sans-serif; color: #777; }
</style>
@endpush

@section('content')
<div class="testimoni-saran-page container"> {{-- Ganti nama class utama --}}
    <div class="page-header" data-aos="fade-up">
        <h1 class="page-title">Apa Kata Mereka?</h1>
        <p class="page-subtitle">Lihat testimoni dan saran berharga dari para pengunjung Agatha Space.</p>
        @auth
        <button class="btn btn-toggle-form" id="btnToggleForm" data-aos="zoom-in" data-aos-offset="0">
            <i class="fas fa-plus-circle"></i> Beri Testimoni atau Saran
        </button>
        @else
        {{-- Pastikan route 'testimoni.list' sudah benar di web.php --}}
        <p class="mt-3 poppins-font" data-aos="fade-up" data-aos-delay="100">Ingin memberi masukan? Silakan <a href="{{ route('login', ['redirect_to' => route('testimoni.list', ['show_form' => 'true'])]) }}">masuk</a> atau <a href="{{ route('register') }}">daftar</a> terlebih dahulu.</p>
        @endauth
    </div>

    @if (session('success_submit'))
        <div class="alert alert-success text-center mb-4" role="alert" data-aos="fade-down">
            <i class="fas fa-check-circle me-2"></i> {{ session('success_submit') }}
        </div>
    @endif

    <div id="formTestimoniSaranWrapper" {{-- Ganti ID wrapper form --}}
         class="form-testimoni-saran-wrapper {{ $showForm ? '' : 'd-none' }}"  {{-- Ganti nama class wrapper form --}}
         data-aos="fade-down"
    >
        <h3 class="form-title">Formulir Testimoni & Saran</h3> {{-- Ganti judul form --}}

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

        {{-- Pastikan route 'testimoni.store' sudah benar di web.php --}}
        <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="no_hp" class="form-label">Nomor HP (Opsional)</label>
                    <input type="tel" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Isi dengan No telepon Anda">
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Masukan</label>
                <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                    <option value="" selected disabled>Pilih jenis</option>
                    <option value="testimoni" {{ old('jenis') == 'testimoni' ? 'selected' : '' }}>Testimoni</option>
                    <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
                    {{-- Jika "Kritik" masih ada sebagai opsi, uncomment baris berikut --}}
                    {{-- <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option> --}}
                </select>
                @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan Anda</label>
                <textarea name="pesan" id="pesan" rows="4" class="form-control @error('pesan') is-invalid @enderror" required placeholder="Tuliskan testimoni atau saran Anda di sini...">{{ old('pesan') }}</textarea>
                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="gambar" class="form-label">Unggah Gambar (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/jpeg,image/png,image/gif">
                <small class="form-text text-muted mt-1 poppins-font">Maks. 5MB. Format: JPG, PNG, GIF.</small>
                @error('gambar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim Masukan</button> {{-- Class tombol bisa disesuaikan --}}
            </div>
        </form>
    </div>

    <div class="masukan-list-section"> {{-- Ganti nama class jika perlu --}}
        <div class="row gy-4 justify-content-center">
            {{-- UBAH NAMA VARIABEL LOOP menjadi $testimonis (atau sesuai yang dikirim controller) --}}
            @forelse ($testimonis as $item)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="masukan-card w-100">
                        <div class="card-header-info">
                            <div class="user-info">
                                <h5 class="card-title">{{ ($item->nama) }}</h5>
                                <p class="text-muted">{{ $item->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm') }}</p>
                            </div>
                            @if($item->jenis == 'testimoni')
                                <span class="badge bg-testimoni flex-shrink-0">
                                    <i class="fas fa-star me-1"></i> Testimoni
                                </span>
                            @elseif($item->jenis == 'saran')
                                <span class="badge bg-saran flex-shrink-0">
                                    <i class="fas fa-lightbulb me-1"></i> Saran
                                </span>
                            @elseif($item->jenis == 'kritik') {{-- Jika masih ada jenis 'kritik' di data lama --}}
                                <span class="badge bg-kritik flex-shrink-0">
                                    <i class="fas fa-thumbs-down me-1"></i> Kritik
                                </span>
                            @else
                                <span class="badge bg-secondary flex-shrink-0">
                                    {{ ucfirst($item->jenis ?: 'Masukan') }}
                                </span>
                            @endif
                        </div>
                        <p class="pesan-text fst-italic">"{{ Str::limit($item->pesan, 150) }}"</p>

                        @if ($item->gambar)
                            <a href="#" class="gambar-link mt-auto" data-bs-toggle="modal" data-bs-target="#imageModal-{{$item->id}}">
                                <i class="fas fa-paperclip me-1"></i> Gambar dari {{ Str::words($item->nama, 1, '') }}
                            </a>
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
                    <div class="no-masukan-message">
                        <i class="fas fa-comments"></i>
                        <p>Belum ada testimoni atau saran yang dapat ditampilkan.</p>
                        @auth
                        <p>Jadilah yang pertama memberi masukan!</p>
                        @endauth
                    </div>
                </div>
            @endforelse
        </div>

        {{-- UBAH NAMA VARIABEL PAGINASI menjadi $testimonis --}}
        @if ($testimonis instanceof \Illuminate\Pagination\LengthAwarePaginator && $testimonis->hasPages())
            <div class="mt-5 pt-3 d-flex justify-content-center" data-aos="fade-up">
                {{ $testimonis->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnToggleForm = document.getElementById('btnToggleForm');
        const formWrapper = document.getElementById('formTestimoniSaranWrapper'); // Ganti ID wrapper form
        const selectJenis = document.getElementById('jenis');

        if (selectJenis) {
            const setSelectPlaceholderStyle = () => {
                if (selectJenis.value === "" || selectJenis.value === null) {
                    selectJenis.classList.add('placeholder-style');
                } else {
                    selectJenis.classList.remove('placeholder-style');
                }
            };
            setSelectPlaceholderStyle();
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

        const successAlert = document.querySelector('.alert.alert-success[role="alert"]');
        const errorAlert = document.querySelector('.alert.alert-danger[role="alert"]');

        if (formWrapper && !formWrapper.classList.contains('d-none')) {
            const elementToScrollTo = errorAlert || formWrapper;
            setTimeout(() => {
                elementToScrollTo.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 250);
        } else if (successAlert) {
             setTimeout(() => {
                successAlert.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });
            }, 150);
        }

        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 600, once: true, offset: 50 });
        }
    });
</script>
@endpush
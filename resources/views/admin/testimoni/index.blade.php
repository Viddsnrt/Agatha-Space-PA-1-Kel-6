@extends('admin.layouts.app') {{-- Sesuaikan dengan layout admin Anda, mungkin adminlte.page atau lainnya --}}

@section('title', 'Daftar Testimoni & Saran') {{-- Judul Halaman --}}

{{-- Jika Anda menggunakan AdminLTE atau template yang memiliki section untuk judul halaman --}}
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Daftar Testimoni & Saran</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Testimoni & Saran</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Testimoni & Saran Pengguna</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.testimoni.export.pdf') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="kritikSaranTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Jenis</th>
                                    <th>Pesan</th>
                                    <th>Gambar</th>
                                    <th>Tampilkan di Web?</th>
                                    <th>Tanggal Kirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($testimonis as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_hp ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->jenis == 'testimoni' ? 'danger' : 'success' }}">
                                            {{ ucfirst($item->jenis) }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($item->pesan, 70) }}</td> {{-- Batasi panjang pesan agar tabel rapi --}}
                                    <td>
                                        @if ($item->gambar)
                                            {{-- Pastikan path ke gambar benar, jika 'storage/app/public' adalah symlink dari 'public/storage' --}}
                                            {{-- maka asset('storage/' . $item->gambar) sudah benar. --}}
                                            {{-- Jika Anda menyimpan langsung di 'public/images/kritiksaran' misalnya, maka pathnya akan beda. --}}
                                            <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank" data-toggle="tooltip" title="Lihat Gambar">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" width="60" class="img-thumbnail">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->tampilkan ? 'primary' : 'secondary' }}">
                                            {{ $item->tampilkan ? 'Ya' : 'Tidak' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.testimoni.updateTampilkan', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Anda yakin ingin mengubah status tampilkan untuk item ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-xs {{ $item->tampilkan ? 'btn-warning' : 'btn-info' }}" data-toggle="tooltip" title="{{ $item->tampilkan ? 'Sembunyikan' : 'Tampilkan' }} di Web">
                                                <i class="fas fa-eye{{ $item->tampilkan ? '-slash' : '' }}"></i>
                                            </button>
                                        </form>

                                        {{-- Tombol Hapus Diaktifkan --}}
                                        <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Anda yakin ingin menghapus item ini? Ini tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data testimoni & saran.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                {{-- Jika Anda menggunakan paginasi di controller, tampilkan link paginasi --}}
                {{-- <div class="card-footer clearfix">
                    {{ $kritiksarans->links() }}
                </div> --}}
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@push('styles')
    {{-- Jika Anda menggunakan DataTables atau CSS tambahan --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> --}}
    <style>
        .img-thumbnail {
            object-fit: cover;
            height: 40px; /* Sesuaikan tinggi thumbnail gambar */
        }
        /* Tambahkan sedikit margin antar tombol aksi jika berdekatan */
        .table td form.d-inline-block + form.d-inline-block {
            margin-left: 5px;
        }
    </style>
@endpush

@push('scripts')
    {{-- Jika Anda menggunakan DataTables atau JS tambahan --}}
    {{-- <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> --}}
    <script>
        $(function () {
            // Inisialisasi DataTables jika digunakan
            // $("#kritikSaranTable").DataTable({
            //     "responsive": true,
            //     "lengthChange": false,
            //     "autoWidth": false,
            //     // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"] // Jika ingin tombol bawaan DataTables
            // }).buttons().container().appendTo('#kritikSaranTable_wrapper .col-md-6:eq(0)');

            // Inisialisasi Tooltip Bootstrap
            $('[data-toggle="tooltip"]').tooltip();

            // Menghilangkan alert setelah beberapa detik
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000); // 4 detik
        });
    </script>
@endpush
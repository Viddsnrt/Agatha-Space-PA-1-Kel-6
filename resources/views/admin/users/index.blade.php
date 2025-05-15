@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Manajemen Pengguna</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pengguna Sistem</h3>
                    {{-- <div class="card-tools">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </a>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Email Terverifikasi</th>
                                <th>Role</th>
                                <th>Dibuat Pada</th>
                                <th>Diperbarui Pada</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->email_verified_at)
                                            <span class="badge badge-success">{{ $user->email_verified_at->format('d M Y, H:i') }}</span>
                                        @else
                                            <span class="badge badge-warning">Belum Terverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->is_admin)
                                            <span class="badge badge-primary">Admin</span>
                                        @else
                                            <span class="badge badge-secondary">User</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $user->updated_at->format('d M Y, H:i') }}</td>
                                    {{-- <td>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                @if($users->hasPages())
                <div class="card-footer clearfix">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
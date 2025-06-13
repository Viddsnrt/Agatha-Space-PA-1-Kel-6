<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">Agatha Space</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.menus.index') }}" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>Menu</p>
            </a>
            <li class="nav-item">
  <a href="{{ route('admin.gallery.index') }}" class="nav-link">
    <i class="nav-icon fas fa-images"></i>
    <p>Galeri</p>
  </a>

  <li class="nav-item">
  <a href="{{ route('admin.testimoni.index') }}" class="nav-link">
    <i class="nav-icon fas fa-comment-dots"></i> 
    <p>Testimoni & Saran</p>
  </a>

  <li class="nav-item">
  <a href="{{ route('admin.promo-event.index') }}" class="nav-link">
    <i class="nav-icon fas fa-bullhorn"></i>
    <p>Promo & Event</p>
  </a>

  <li class="nav-item">
  <a href="{{ route('admin.table.index') }}" class="nav-link">
    <i class="nav-icon fas fa-concierge-bell "></i>
    <p>Reservasi</p>
</a>

     <li class="nav-item">
      <a href="{{ route('admin.users.index') }}" class="nav-link">
      <i class= "nav-icon fas fa-users "> </i>
      <p>Kelola Pengguna</p>
</a>

        <li class="nav-item">
          <a href="{{ route('admin.orders.index') }}" class="nav-link">
            <i class= "nav-icon fas fa-shopping-cart "> </i>
            <p>Pesanan Pelanggan</p>
</a>
    
      
</li>

</li>


</li>

          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="nav-link btn btn-link text-left text-white">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </button>
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12"> {{-- Atau col-sm-6 jika Anda ingin breadcrumb di sebelahnya --}}
            {{-- DI SINI TEMPAT UNTUK CONTENT HEADER --}}
            @yield('content_header')
          </div><!-- /.col -->
          {{-- Anda bisa menambahkan breadcrumb di sini jika mau --}}
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- KONTEN UTAMA HALAMAN --}}
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>&copy; {{ date('Y') }} Agatha Space</strong>
  </footer>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>

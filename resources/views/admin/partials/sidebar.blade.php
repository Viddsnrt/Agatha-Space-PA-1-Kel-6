<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">Agatha Admin</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="/admin" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Menu -->
        <li class="nav-item">
          <a href="{{ route('menus.index') }}" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>Menu</p>
          </a>
        </li>

        <!-- Reservasi -->
        <li class="nav-item">
          <a href="{{ route('reservations.index') }}" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>Reservasi</p>
          </a>
        </li>

        <!-- Pelanggan -->
        <li class="nav-item">
          <a href="{{ route('customers.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Pelanggan</p>
          </a>
        </li>

        <!-- Transaksi -->
        <li class="nav-item">
          <a href="{{ route('transactions.index') }}" class="nav-link">
            <i class="nav-icon fas fa-receipt"></i>
            <p>Transaksi</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

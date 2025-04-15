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

        <!-- Kategori -->
        <li class="nav-item">
          <a href="{{ route('admin.categories.index') }}" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>Kategori</p>
          </a>
        </li>

        <!-- Menu -->
        <li class="nav-item">
          <a href="{{ route('admin.menus.index') }}" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>Menu</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <span class="brand-text font-weight-light center">MySkin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('index.dokter')}}" class="nav-link">
            <i class=" far nav-icon fas fa-edit"></i>
            <p>Dokter</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class=" far nav-icon fas fa-edit"></i>
            <p>Artikel</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('index.transaksi')}}" class="nav-link">
            <i class=" far nav-icon fas fa-edit"></i>
            <p>Transaksi</p>
          </a>
        </li>
        
        <li class="nav-item">
        <a href="{{route('logout')}}" class="nav-link">
        <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
        <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
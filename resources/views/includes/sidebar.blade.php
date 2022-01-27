
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link active">
              <i class="nav-icon fa fa-user"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/banner" class="nav-link">
              <i class="nav-icon fa fa-film"></i>
              <p>
                Banner Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/category" class="nav-link">
              <i class="nav-icon fa fa-list-alt"></i>
              <p>
                Category Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/product" class="nav-link">
              <i class="nav-icon fa fa-cube"></i>
              <p>
                Product Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/coupon" class="nav-link">
              <i class="nav-icon fa fa-gift"></i>
              <p>
                Coupon Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/contact-us" class="nav-link">
              <i class="nav-icon fa fa-phone"></i>
              <p>
                Contact Us
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/cms" class="nav-link">
              <i class="nav-icon fa fa-check-square"></i>
              <p>
                CMS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/orders" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
                Order Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <li class="nav-item ">
               
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             <i class="nav-icon fa fa-sign-out"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
    </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
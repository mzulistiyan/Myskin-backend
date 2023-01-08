<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-light">
  <ul class="navbar-nav ml-auto" style="color: #D71619;">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
      <li class="nav-item">
        <form id="logout-form" action="{{ url('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="dropdown-item nav-link ">Logout</button>
          </form>
      </li>
    </ul>
    </li>
  </ul>
</nav>
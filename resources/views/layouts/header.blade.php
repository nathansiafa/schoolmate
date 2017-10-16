<header class="main-header">

  <!-- Logo -->
  <a href="javascript:void(0)" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini" style="font-family:  Raleway;"><b>S</b>MT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="font-family:  Raleway;"><b>School</b>MATE</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->

        <li style="padding-right: 10px">
          @foreach($academics as $academic)
             <b class="label pull-right bg-aqua" style="margin-top: 11%; font-size: 12px; font-family:  Raleway;" > Academic Year: {{$academic->date_start->year}} - {{$academic->date_end->year}}</b> 
          @endforeach
        </li>

        <!-- Authentication Links -->
        @yield('user-logout')
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>
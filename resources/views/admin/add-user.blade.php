<?php  $user=request()->user(); $id=$user->id;?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @auth
      <li class="nav-item d-none d-sm-inline-block">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="btn btn-primary">Log Out</button>
        </form>
      </li>
      @endauth
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/task" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user-image.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/dashboard" class="d-block"><?php $user=request()->user(); echo $user->name; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/manage-user" class="nav-link">
              <p>
                Manage-User
              </p>
            </a>
            <li class="nav-item">
            <a href="/add-user" class="nav-link">
              <p>
                Add-User
              </p>
            </a>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper" >
<div class="register-page" style="padding-top:0px;margin-top:0px">
  <div class="register-box">

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Create a new user</p>

      <form action="/add-user" method="post">
        @csrf
        <input type="hidden" id="admin_id" name="admin_id" value=<?php echo $id; ?>>
        <x-form-input type="text" id="name" name="name" placeholder="Full name" />
        <x-form-error name="name" /> 
        
        <x-form-input  type="email" id="email" name="email" placeholder="Email"/>
        <x-form-error name="email" />
        <label for="role">Choose Role:</label>
        <input list="role" name="role">
          <datalist id="role" class="role">
            <option value="manager">
            <option value="user">
          </datalist>
        <x-form-error name="role"/> 

         <x-form-input type="password" id="password" name="password" placeholder="password" />
        <x-form-error name="password" />

         <x-form-input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype-password" />
        <x-form-error name="password_confirmation" />


        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            </div>
          </div>
          <!-- /.col -->
          <x-form-submit type="submit">Register</x-form-submit>
          <!-- /.col -->
        </div>
      </form>
</div>
    </div>
    
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
</div>
<!-- /.register-box -->
<x-footer />
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kyaw Chinese Restaurant</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex justify-content-between">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars text-dark"></i>
        </a>
      </li>


    </ul>
    <div class="float-right mr-5">
        <form action="{{route('logout')}}" method="POST">
            @csrf

                {{-- <a href="" class="nav-link"><i class="fas fa-sign-out-alt"></i><input type="submit" value="logout" class="btn btn-sm btn-dark text-white btn-outline-danger"></a> --}}

                <div class="dropdown">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" >
                        {{Auth()->user()->name}}
                </button>
                    <ul class="dropdown-menu" style="min-width:auto; border:none; min-height: auto"  >
                      <li><a href=""><input type="submit" value="   logout   " class="btn btn-sm btn-secondary text-white btn-outline-danger" style="border: none"></a></li>
                    </ul>
                  </div>

        </form>
    </div>

  </nav>
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="background:#fb8c00;height:100vh">
    <a href="{{route('admin#profile')}}" class="brand-link text-decoration-none">

      <span class="brand-text font-weight-dark"><b>Kyaw Chinese Restaurant</b></span>
    </a>
    <div class="sidebar">
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#profile')}}" class="nav-link">
              <i class="fas fa-user-circle"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#category')}}" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Category
              </p>
            </a>
          </li>

          <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#menu')}}" class="nav-link">
                <i class="fas fa-utensils"></i>
              <p>
               Menu
              </p>
            </a>
          </li>

         <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#userList')}}" class="nav-link">
            <i class="fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>

          <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#order')}}" class="nav-link">
              <i class="fas fa-book"></i>
              <p>
                Order
              </p>

            </a>
          </li>
          <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#total')}}" class="nav-link">
              <i class="fas fa-book"></i>
              <p>
                Total
              </p>

            </a>
          </li>
          <li class="nav-item my-2 fs-6">
            <a href="{{route('admin#contactList')}}" class="nav-link">
              <i class="fas fa-address-book"></i>
              <p>
                Contact
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

@yield('content')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

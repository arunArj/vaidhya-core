<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>
<body>
    <div id="app">
        @include('components.theme.sidebar')
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, {{auth()->user()->name}}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('dashboard')
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Vaidhya</p>
                    </div>
                    <div class="float-end">
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ URL::asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script src="{{ URL::asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
</body>
</html>

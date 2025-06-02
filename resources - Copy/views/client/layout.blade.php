@if (!Session::has('client_email_login'))
    <script type="text/javascript">
        window.location.href = "{{ route('client_index') }}";
    </script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mellow Elements - Client Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap & CSS -->
    <link href="{{ asset('public/client/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/client/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background-color: #1f2937;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 240px;
        }

        .sidebar .nav-link {
            color: white;
            font-weight: 500;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #374151;
            border-radius: 8px;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f8f9fa;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
        }

        .profile-dropdown .dropdown-menu {
            right: 0;
            left: auto;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4">Mellow Elements</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('client_dashboard') }}" class="nav-link {{ request()->routeIs('client_dashboard') ? 'active' : '' }}">
                    <i class="material-icons">dashboard</i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('client_profile') }}" class="nav-link {{ request()->routeIs('client_profile') ? 'active' : '' }}">
                    <i class="material-icons">person</i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('client_resource') }}" class="nav-link {{ request()->routeIs('client_resource') ? 'active' : '' }}">
                    <i class="material-icons">build</i> Resource
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('client_ongoing_resource') }}" class="nav-link {{ request()->routeIs('client_ongoing_resource') ? 'active' : '' }}">
                    <i class="material-icons">hourglass_bottom</i> Ongoing
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('client_completed_resource') }}" class="nav-link {{ request()->routeIs('client_completed_resource') ? 'active' : '' }}">
                    <i class="material-icons">check_circle</i> Completed
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('hiredDevelopersList') }}" class="nav-link {{ request()->routeIs('hiredDevelopersList') ? 'active' : '' }}">
                    <i class="material-icons">person</i> TL/Manager
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('client_change_password') }}" class="nav-link {{ request()->routeIs('client_change_password') ? 'active' : '' }}">
                    <i class="material-icons">settings</i> Settings
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content w-100">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Client Dashboard</h5>
            <div class="dropdown profile-dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="profileDropdown" data-toggle="dropdown">
                    <img src="{{ asset('public/front/assets/images/3d.png') }}" width="40" height="40" class="rounded-circle mr-2">
                    <strong>{{ Session::get('client_name_login') }}</strong>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('client_change_password') }}">Settings</a>
                    <a class="dropdown-item" href="{{ route('resource') }}">Resource</a>
                    <a class="dropdown-item" href="{{ route('assign_work') }}">Assign Work</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('user_logout') }}">Log out</a>
                </div>
            </div>
        </div>

        <!-- Yielded Page Content -->
        @yield('content')

        <!-- Footer -->
        <div class="footer mt-5">
            &copy; {{ date('Y') }} Mellow Elements. All rights reserved.
        </div>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('public/client/assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('public/client/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

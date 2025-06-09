<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Title -->
    <title>Mellow Elements! - College Dashboard</title>

    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('public/admin/assets/css/connect.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/css/admin2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/css/dark_theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/css/custom.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ URL::asset('public/front/js/sweetalert2.js') }}"></script>

    <style>
    .geeks {
        width: 200px;
        height: 150px;
        overflow: hidden;
        margin: 0 auto;
    }

    .geeks img {
        width: 100%;
        transition: 0.5s all ease-in-out;
    }

    .geeks:hover img {
        transform: scale(1.5);
    }
    </style>

</head>

<body>
    <!--<div class='loader'>-->
    <!--    <div class='spinner-grow text-primary' role='status'>-->
    <!--        <span class='sr-only'>Loading...</span>-->
    <!--    </div>-->
    <!--</div>-->

    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="page-container">
            <div class="page-header">
                <nav class="navbar navbar-expand container">
                    <div class="logo-box"><a href="{{ route('dashboard')}}" class="logo-text">Mellow Elements</a></div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="navbar-nav">
                        <li class="nav-item small-screens-sidebar-link">
                            <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}"
                                    alt="profile image">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="change_password">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                            </div>
                        </li>
                    </ul>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link"></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="horizontal-bar">
                <div class="logo-box">
                    <a href="#" class="logo-text">Connect</a>
                </div>
                <a href="#" class="hide-horizontal-bar"><i class="material-icons">close</i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="horizontal-bar-menu">
                               
                                <ul>
                                    <!-- Dashboard -->
                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                            <i class="material-icons">dashboard</i> Dashboard
                                        </a>
                                    </li>

                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @yield('content')
            {{-- Footer --}}
            <footer class="footer mt-auto py-3 bg-light">
                <div class="container text-center">
                    <span class="text-muted">© {{ date('Y') }} MeloowVoult. All rights reserved.</span>
                </div>
            </footer>
            <!-- <div class="page-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="footer-text">2025 © Mellow Elements</span>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ URL::asset('public/admin/assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ URL::asset('public/admin/assets/plugins/DataTables/datatables.min.js') }}"></script>

    <script src="{{ URL::asset('public/admin/assets/js/connect.min.js') }}"></script>

    <script src="{{ URL::asset('public/admin/assets/js/pages/datatables.js') }}"></script>

    <script src="{{ URL::asset('public/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>


    <script src="{{ URL::asset('public/admin/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{URL::asset('public/admin/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script>
    CKEDITOR.replace('content');
    </script>
    <script>
    CKEDITOR.replace('Additions');
    </script>
    <script>
    CKEDITOR.replace('Overview');
    </script>


    <script>
    $(document).ready(function() {
        $('#c_id').on('change', function() {
            var c_id = $('#c_id').val();
            var v_token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                url: "{{route('show')}}",
                data: {
                    c_id: c_id,
                    _token: v_token
                },
                success: function(response) {
                    $('#subcategory_id').html(response);
                }
            });
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#complex-header').DataTable();
    });
    </script>

    <script type="text/javascript">
    function update_status(developer_status, dev_id) {
        var developer_status = developer_status;
        var dev_id = dev_id;
        var v_token = "{{csrf_token()}}";
        $.ajax({
            type: "POST",
            url: "{{route('developer_status')}}",
            data: {
                developer_status: developer_status,
                dev_id: dev_id,
                _token: v_token
            },
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }
    </script>

    <script>
    $("#checkAl").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    </script>



</body>

</html>
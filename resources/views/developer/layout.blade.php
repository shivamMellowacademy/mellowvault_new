@if(Session::get('developer_email_login') == null)
<script type="text/javascript">
window.location.href = "developer_admin";
</script>
@endif

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
    <title>Mellow Elements! - Home - Developer Dashboard</title>

    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('public/developer/assets/css/connect.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/admin2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/dark_theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/custom.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>
    .geeks {
        width: 200px;
        height: 200px;
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
                    <div class="logo-box"><a href="{{ route('developer_dashboard')}}" class="logo-text">Mellow
                            Elements</a></div>
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
                                <img src="{{ URL::asset('public/front/assets/images/3d.png') }}" alt="profile image">
                                <?php if(!empty(Session::get('developer_name_login'))){?>
                                <span style=" text-transform: capitalize;">Hi,

                                    <?php echo $name =Session::get('developer_name_login'); ?>
                                </span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                <?php } ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('developer_change_password')}}">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('developer_log')}}">Log out</a>
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
                    <div class="navbar-search">
                        <form>
                            <div class="form-group">
                                <input type="text" name="search" id="nav-search" placeholder="Search...">
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
            <div class="horizontal-bar">
                <div class="logo-box"><a href="#" class="logo-text">Connect</a></div>
                <a href="#" class="hide-horizontal-bar"><i class="material-icons">close</i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="horizontal-bar-menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('developer_dashboard') }}"
                                            class="{{ request()->routeIs('developer_dashboard') ? 'active' : '' }}">
                                            <i class="material-icons">dashboard</i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('developer_profile') }}"
                                            class="{{ request()->routeIs('developer_profile') ? 'active' : '' }}">
                                            <i class="material-icons">face</i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('developer_interview_schedule_details') }}"
                                            class="{{ request()->routeIs('developer_interview_schedule_details') ? 'active' : '' }}">
                                            <i class="material-icons">manage_accounts</i> Interview Schedule
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('developer_kyc') }}"
                                            class="{{ request()->routeIs('developer_kyc') ? 'active' : '' }}">
                                            <i class="material-icons">subject</i> KYC
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('bank_details') }}"
                                            class="{{ request()->routeIs('bank_details') ? 'active' : '' }}">
                                            <i class="material-icons">note</i> Bank Details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('developer_resource') }}"
                                            class="{{ request()->routeIs('developer_resource') ? 'active' : '' }}">
                                            <i class="material-icons">info</i> Client Details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('wallet_details') }}"
                                            class="{{ request()->routeIs('wallet_details') ? 'active' : '' }}">
                                            <i class="material-icons">assignment</i> Wallet
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('developer_change_password') }}"
                                            class="{{ request()->routeIs('developer_change_password') ? 'active' : '' }}">
                                            <i class="material-icons">settings</i> Settings
                                        </a>
                                    </li>
                                    <li>
                                         <a href="{{ route('developer_premium') }}"
                                             class="{{ request()->routeIs('developer_change_password') ? 'active' : '' }}">
                                             <i class="fa fa-credit-card" aria-hidden="true"></i>  Buy premium package
                                         </a>
                                     </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            <div class="page-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="footer-text">2021 © Mellow Elements</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}">
    </script>

    <script src="{{ URL::asset('public/developer/assets/plugins/DataTables/datatables.min.js') }}"></script>

    <script src="{{ URL::asset('public/developer/assets/js/connect.min.js') }}"></script>

    <script src="{{ URL::asset('public/developer/assets/js/pages/datatables.js') }}"></script>

    <script src="{{ URL::asset('public/developer/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>


    <script src="{{ URL::asset('public/developer/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{URL::asset('public/developer/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
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
                url: "{{route('work_show')}}",
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



</body>

</html>
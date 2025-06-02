@if(Session::get('admin_email_login') == null)
<script type="text/javascript">
window.location.href = "adminindex";
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
    <title>Mellow Elements! - Home - Admin Dashboard</title>

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


                                @if(isset($rolesdetails))

                                <?php
                                   
                                    $id=Session::get('admin_email_role');
                                    // echo $id; exit();
                                    foreach($rolesdetails as $d){
                                    if($d->role == "Admin"){
                                    
                                    ?>
                                <span>Admin</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                <?php }elseif($d->role == "HR"){ ?>
                                <span>HR</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                <?php }elseif($d->role == "Blogger"){ ?>
                                <span>Blogger</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>

                                <?php } } ?>
                                @endif
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
                <div class="logo-box">
                    <a href="#" class="logo-text">Connect</a>
                </div>
                <a href="#" class="hide-horizontal-bar"><i class="material-icons">close</i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="horizontal-bar-menu">
                                @if(isset($rolesdetails))
                                @php $id = Session::get('admin_email_role'); @endphp

                                @foreach($rolesdetails as $d)
                                @if($d->role == "Admin")
                                <ul>
                                    <!-- Dashboard -->
                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                            <i class="material-icons">dashboard</i> Dashboard
                                        </a>
                                    </li>

                                    <!-- Banners -->
                                    <li>
                                        <a href="{{ route('banner') }}"
                                            class="{{ request()->routeIs('banner') ? 'active' : '' }}">
                                            <i class="material-icons">vrpano</i> Banners
                                        </a>
                                    </li>

                                    <!-- Overview -->
                                    @php $overviewRoutes = ['about', 'License']; @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $overviewRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">move_up</i> Overview <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('about') }}"
                                                    class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                                            </li>
                                            <li><a href="{{ route('License') }}"
                                                    class="{{ request()->routeIs('License') ? 'active' : '' }}">Commercial
                                                    License</a></li>
                                        </ul>
                                    </li>

                                    <!-- Category Details -->
                                    @php $categoryRoutes = ['category', 'subcategory']; @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $categoryRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">category</i> Category Details <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('category') }}"
                                                    class="{{ request()->routeIs('category') ? 'active' : '' }}">Add
                                                    Category</a></li>
                                            <li><a href="{{ route('subcategory') }}"
                                                    class="{{ request()->routeIs('subcategory') ? 'active' : '' }}">Sub-Category</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Web Hosting -->
                                    <li>
                                        <a href="{{ route('web_hosting') }}"
                                            class="{{ request()->routeIs('web_hosting') ? 'active' : '' }}">
                                            <i class="material-icons">domain_add</i> Web Hosting
                                        </a>
                                    </li>

                                    <!-- Product Management -->
                                    @php $productRoutes = ['products', 'addproducts']; @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $productRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">production_quantity_limits</i> Add Product <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('products') }}"
                                                    class="{{ request()->routeIs('products') ? 'active' : '' }}">All
                                                    Products</a></li>
                                            <li><a href="{{ route('addproducts') }}"
                                                    class="{{ request()->routeIs('addproducts') ? 'active' : '' }}">Add
                                                    Product</a></li>
                                        </ul>
                                    </li>

                                    <!-- Product Order -->
                                    <li>
                                        <a href="{{ route('product_order') }}"
                                            class="{{ request()->routeIs('product_order') ? 'active' : '' }}">
                                            <i class="material-icons">shopping_cart</i> Product Order
                                        </a>
                                    </li>

                                    <!-- Developer Sections -->
                                    @php $devRoutes = ['hig_prof', 'active_developer_details',
                                    'developer_project_details', 'premium_developer', 'interview_schedule_developer'];
                                    @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $devRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">manage_accounts</i> Higher Professional <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('hig_prof') }}"
                                                    class="{{ request()->routeIs('hig_prof') ? 'active' : '' }}">Add
                                                    Professional Category</a></li>
                                            <li><a href="{{ route('active_developer_details') }}"
                                                    class="{{ request()->routeIs('active_developer_details') ? 'active' : '' }}">Professional
                                                    Developer Details</a></li>
                                            <li><a href="{{ route('developer_project_details') }}"
                                                    class="{{ request()->routeIs('developer_project_details') ? 'active' : '' }}">Developer
                                                    Project Details</a></li>
                                            <li><a href="{{ route('premium_developer') }}"
                                                    class="{{ request()->routeIs('premium_developer') ? 'active' : '' }}">Premium
                                                    Developer</a></li>
                                            <li><a href="{{ route('interview_schedule_developer') }}"
                                                    class="{{ request()->routeIs('interview_schedule_developer') ? 'active' : '' }}">Interview
                                                    Resource</a></li>
                                                    
                                                    <li>
                                                <a href="{{ route('resoure_details') }}"
                                                    class="{{ request()->routeIs('resoure_details') ? 'active' : '' }}">
                                                    <!-- <i class="material-icons">integration_instructions</i>  -->
                                                    Resource
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('requested_developer_details') }}"
                                                    class="{{ request()->routeIs('requested_developer_details') ? 'active' : '' }}">
                                                    <!-- <i class="material-icons">verified_user</i>  -->
                                                    Developer Request
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <li>
                                        <a href="#" class="{{ in_array(Route::currentRouteName(), $devRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">manage_accounts</i> 
                                            Payment Due
                                            <i class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="{{route('employee.salary.due')}}" class="{{ request()->routeIs('employee.salary.due') ? 'active' : '' }}">
                                                    Employee salary Due
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('employee.advance.due')}}" class="{{ request()->routeIs('employee.advance.due') ? 'active' : '' }}">
                                                    Employee advance salary Due
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Employers -->
                                    <li>
                                        <a href="{{ route('employer.list') }}"
                                            class="{{ request()->routeIs('employer.list') ? 'active' : '' }}">
                                            <i class="material-icons">verified_user</i> Employers
                                        </a>
                                    </li>

                                    <!-- Reward -->
                                    <li>
                                        <a href="{{ route('request_for_reward') }}"
                                            class="{{ request()->routeIs('request_for_reward') ? 'active' : '' }}">
                                            <i class="material-icons">military_tech</i> Reward
                                        </a>
                                    </li>

                                    <!-- Visitors -->
                                    <li>
                                        <a href="{{ route('all_visitor') }}"
                                            class="{{ request()->routeIs('all_visitor') ? 'active' : '' }}">
                                            <i class="material-icons">settings_accessibility</i> All Visitors
                                        </a>
                                    </li>

                                    <!-- Quick Links -->
                                    @php $quickRoutes = ['faqs', 'blog', 'refund', 'privacy_policy', 'term_condition'];
                                    @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $quickRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">add_link</i> Quick Links <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('faqs') }}"
                                                    class="{{ request()->routeIs('faqs') ? 'active' : '' }}">FAQs</a>
                                            </li>
                                            <li><a href="{{ route('blog') }}"
                                                    class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blogs</a>
                                            </li>
                                            <li><a href="{{ route('refund') }}"
                                                    class="{{ request()->routeIs('refund') ? 'active' : '' }}">Refund
                                                    Policy</a></li>
                                            <li><a href="{{ route('privacy_policy') }}"
                                                    class="{{ request()->routeIs('privacy_policy') ? 'active' : '' }}">Privacy
                                                    Policy</a></li>
                                            <li><a href="{{ route('term_condition') }}"
                                                    class="{{ request()->routeIs('term_condition') ? 'active' : '' }}">Terms
                                                    & Conditions</a></li>
                                        </ul>
                                    </li>

                                    <!-- Contact Information -->
                                    @php $contactRoutes = ['add_contact', 'contactus', 'free_consultations']; @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $contactRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">contacts</i> Contact Information <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('add_contact') }}"
                                                    class="{{ request()->routeIs('add_contact') ? 'active' : '' }}">Add
                                                    Contact Details</a></li>
                                            <li><a href="{{ route('contactus') }}"
                                                    class="{{ request()->routeIs('contactus') ? 'active' : '' }}">Contact
                                                    Users</a></li>
                                            <li><a href="{{ route('free_consultations') }}"
                                                    class="{{ request()->routeIs('free_consultations') ? 'active' : '' }}">Free
                                                    Consultation</a></li>
                                        </ul>
                                    </li>


                                    <!-- Web Settings -->
                                    <li>
                                        <a href="{{ route('web_setting') }}"
                                            class="{{ request()->routeIs('web_setting') ? 'active' : '' }}">
                                            <i class="material-icons">settings</i> Web Settings
                                        </a>
                                    </li>

                                    <!-- subscriptions plan -->
                                    @php $plansRoutes = ['premium', 'subscription_plan']; @endphp
                                    <li>
                                        <a href="#"
                                            class="{{ in_array(Route::currentRouteName(), $plansRoutes) ? 'active' : '' }}">
                                            <i class="material-icons">move_up</i> Plans <i
                                                class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                        <ul>
                                            <li><a href="{{ route('premium') }}"
                                                    class="{{ request()->routeIs('premium') ? 'active' : '' }}">Try to Premium</a>
                                            </li>
                                            <li><a href="{{ route('subscription_plans.index') }}"
                                                    class="{{ request()->routeIs('subscription_plans.index') ? 'active' : '' }}">Subscription Plan</a></li>
                                        </ul>
                                    <!-- <li><a href="{{ route('all_rating') }}"
                                            class="{{ request()->routeIs('all_rating') ? 'active' : '' }}"><i
                                                class="material-icons">star_half</i> Product Rating</a></li> -->
                                </ul>

                                @elseif($d->role == "HR")
                                <!-- HR Sections (similar to Admin but HR specific) -->
                                <ul>
                                    <!-- HR Dashboard -->
                                    <li><a href="{{ route('dashboard') }}"
                                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i
                                                class="material-icons">dashboard</i> Dashboard</a></li>
                                    <li><a href="{{ route('commission') }}"
                                            class="{{ request()->routeIs('commission') ? 'active' : '' }}"><i
                                                class="material-icons">percent</i> Commission</a></li>
                                </ul>

                                @elseif($d->role == "Blogger")
                                <!-- Blogger Sections -->
                                <ul>
                                    <li><a href="{{ route('dashboard') }}"
                                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i
                                                class="material-icons">dashboard</i> Dashboard</a></li>
                                    <li><a href="{{ route('blog') }}"
                                            class="{{ request()->routeIs('blog') ? 'active' : '' }}"><i
                                                class="material-icons">add_link</i> Add Blogs</a></li>
                                </ul>
                                @endif
                                @endforeach
                                @endif
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
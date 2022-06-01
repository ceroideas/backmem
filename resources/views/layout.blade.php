<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Mar 2019 15:42:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('monster-admin/main')}}/../assets/images/favicon.png">
    <title>MEM eCONSULTING - Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url('monster-admin/main')}}/../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    {{-- <link href="{{url('monster-admin/main')}}/../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet"> --}}
    {{-- <link href="{{url('monster-admin/main')}}/../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet"> --}}
    {{-- <link href="{{url('monster-admin/main')}}/../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet"> --}}
    <link href="{{url('monster-admin/main')}}/../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{url('monster-admin/main')}}/../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('monster-admin/main')}}/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{url('monster-admin/main')}}/css/colors/blue.css" id="theme" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{url('monster-admin/main')}}/../assets/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{url('monster-admin/main')}}/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="{{url('monster-admin/main')}}/https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    {{-- <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../../../www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-85622565-1', 'auto');
    ga('send', 'pageview');
    </script> --}}
    <style>
        .pull-right {
            float: right;
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('admin')}}" style="height: 69px;">
                        <!-- Logo icon -->
                        {{-- <b> --}}
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            {{-- <img src="{{url('monster-admin/main')}}/../assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> --}}
                            <!-- Light Logo icon -->
                            {{-- <img src="{{url('monster-admin/main')}}/../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> --}}
                        {{-- </b> --}}
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <img src="{{url('logo-mem.jpg')}}" style="width: 100%;" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="{{url('logo-mem.jpg')}}" style="width: 100%;" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item hidden-sm-down" style="display: none;">
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a> </form>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('monster-admin/main')}}/../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{url('monster-admin/main')}}/../assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{Auth::user()->name}}</h4>
                                                <p class="text-muted">{{Auth::user()->email}}</p>
                                                {{-- <a href="{{url('monster-admin/main')}}" class="btn btn-rounded btn-danger btn-sm">View Profile</a> --}}
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    {{-- <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li> --}}
                                    <li><a href="{{url('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="{{url('monster-admin/main')}}/../assets/images/users/1.jpg" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle- link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{Auth::user()->name}} 
                        <span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> <a href="{{url('monster-admin/main')}}/login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a class="" href="{{url('admin/')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Clientes</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/customers')}}">Listar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Técnicos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/technicians')}}">Listar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-map-marker"></i><span class="hide-menu">Puntos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/points')}}">Listar</a></li>
                                <li><a href="{{url('admin/services')}}">Servicios</a></li>
                                <li><a href="{{url('admin/process')}}">Procesos</a></li>
                                <li><a href="{{url('admin/indicators')}}">Indicadores</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-map"></i><span class="hide-menu">Mapas</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/general-map')}}">Mapa general</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Funciones extra</li>

                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Configuración</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#imports" data-toggle="modal">Importar datos</a></li>
                                <li><a href="{{url('admin/export')}}">Exportar datos</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            {{-- <div class="sidebar-footer">
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div> --}}
            <!-- End Bottom points-->
        </aside>

        <div class="modal fade" id="imports">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        Importar datos de clientes
                    </div>
                    <div class="modal-body">
                        <a class="btn btn-sm btn-block btn-info" href="{{url('excel-sample')}}">DESCARGAR EXCEL DE MUESTRA</a>

                        {{-- <br>

                        <form action="{{url('excel-import')}}" method="POST" enctype="multipart/form-data">

                            {{csrf_field()}}

                            <div class="form-group">
                                <label>Seleccione el archivo a cargar</label>
                                <input type="file" class="form-control" name="excel" accept=".xlsx,.csv,.xls">
                            </div>

                            <button class="btn btn-success" type="submit">Enviar</button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            @yield('content')
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2021 Monster Admin by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{url('monster-admin/main')}}/../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    {{-- <script src="{{url('monster-admin/main')}}/../../../../../www.wrappixel.com/demos/admin-templates/monster-admin/assets/plugins/bootstrap/js/popper.min.js"></script> --}}
    <script src="{{url('monster-admin/main')}}/../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url('monster-admin/main')}}/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="{{url('monster-admin/main')}}/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{url('monster-admin/main')}}/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="{{url('monster-admin/main')}}/../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="{{url('monster-admin/main')}}/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    {{-- <script src="{{url('monster-admin/main')}}/../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="{{url('monster-admin/main')}}/../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script> --}}
    <!-- Chart JS -->
    <script src="{{url('monster-admin/main')}}/../assets/plugins/echarts/echarts-all.js"></script>
    <script src="{{url('monster-admin/main')}}/../assets/plugins/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    {{-- <script src="{{url('monster-admin/main')}}/js/dashboard1.js"></script> --}}
    <script src="{{url('monster-admin/main')}}/js/toastr.js"></script>

    <script src="{{url('monster-admin/main')}}/../assets/plugins/datatables/datatables.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
    <script>
        $(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    </script>
    <script>
    // $.toast({
    //     heading: 'Welcome to Monster admin',
    //     text: 'Use the predefined ones, or specify a custom position object.',
    //     position: 'top-right',
    //     loaderBg: '#ff6849',
    //     icon: 'info',
    //     hideAfter: 3000,
    //     stack: 6
    // });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{url('monster-admin/main')}}/../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Mar 2019 15:42:31 GMT -->
</html>
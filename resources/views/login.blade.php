<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Mar 2019 15:42:31 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('monster-admin/main')}}/../assets/images/favicon.png">
    <title>Monster Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url('monster-admin/main')}}/../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('monster-admin/main')}}/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{url('monster-admin/main')}}/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
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
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{url('frontend')}}/assets/img/wizard-book.jpg);">
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{url('login')}}" method="POST">
                    {{csrf_field()}}
                    <h3 class="box-title mb-3">Iniciar sesión</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="text" required="" placeholder="Username"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" type="password" required="" placeholder="Password"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary float-left pt-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Recordarme </label>
                            </div> {{-- <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock mr-1"></i> Olvidé mi contraseá</a> --}} </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Iniciar sesión</button>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                            <div class="social">
                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus"></i> </a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group mb-0">
                        <div class="col-sm-12 text-center">
                            <p>No tienes cuenta? <a href="{{url('register')}}" class="text-info ml-1"><b>Registrarse</b></a></p>
                        </div>
                    </div> --}}
                </form>
                {{-- <form class="form-horizontal" id="recoverform" action="https://wrappixel.com/demos/admin-templates/monster-admin/main/index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recuperar contraseña</h3>
                            <p class="text-muted">Ingresa tu correo y sigue las instrucciones para recuperar tu contraseña! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email"> </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Enviar</button>
                        </div>
                    </div>
                </form> --}}
            </div>
          </div>
        </div>
        
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{url('monster-admin/main')}}/../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('monster-admin/main')}}/../../../../../www.wrappixel.com/demos/admin-templates/monster-admin/assets/plugins/bootstrap/js/popper.min.js"></script>
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{url('monster-admin/main')}}/../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Mar 2019 15:42:37 GMT -->
</html>
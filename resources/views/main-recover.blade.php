<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('/frontend')}}/assets/img/favicon.ico">

	<title>MEM eCONSULTING</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="{{url('/frontend')}}/assets/img/icon.jpg" />
	<link rel="icon" type="image/png" href="{{url('/frontend')}}/assets/img/icon.jpg" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="{{url('/frontend')}}/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="{{url('/frontend')}}/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="{{url('/frontend')}}/assets/css/demo.css" rel="stylesheet" />
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('{{url('/frontend')}}/assets/img/wizard-book.jpg')">
	    <!--   Creative Tim Branding   -->
	    <a href="http://creative-tim.com">
	         {{-- <div class="logo-container">
	            <div class="logo">
	                <img src="{{url('/logo-mem.png')}}">
	            </div>
	            <div class="brand">
	                Creative Tim
	            </div>
	        </div> --}}
	    </a>

		<!--  Made With Material Kit  -->
		{{-- <a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard" class="made-with-mk">
			<div class="brand">MK</div>
			<div class="made-with">Made with <strong>Material Kit</strong></div>
		</a> --}}

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container" style="padding-bottom: 100px;">
		                <div class="card wizard-card" data-color="blue" id="wizardProfile">
		                    <form action="{{ url('send-code') }}" method="POST" id="formulario" enctype="multipart/form-data">
		                    	{{csrf_field()}}
		               			 <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                    		<img src="{{url('/logo-mem.jpg')}}" style="width: 40%;">
									{{-- <h5>This information will let us know more about you.</h5> --}}
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a style="cursor: default;" data-toggle="tab">Recuperar Contraseña</a></li>
			                            {{-- <li><a href="#account" data-toggle="tab">Servicios</a></li> --}}
			                            {{-- <li><a href="#address" data-toggle="tab">Punto y Servicios</a></li> --}}
			                        </ul>
								</div>

		                        <div class="tab-content" style="min-height: 300px">
		                            <div class="tab-pane active" id="about">
		                              <div class="row">
		                                	<h4 class="info-text"> Ingresa tus correo</h4>
		                                	<input type="hidden" name="code" id="codigo">
		                                	<div class="col-sm-6 col-sm-offset-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Email</label>
			                                          <input name="email" type="email" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">

		                        	<h3 class="wizard-title text-center">
		                        	   <small>¿Ya tienes una cuenta? <a href="{{url('/')}}">{{-- <i class="material-icons">arrow_back</i> --}} Iniciar Sesión</a></small>
		                        	</h3>

		                        	<br>


		                            <div class="-pull-right" style="text-align: center;">
		                                {{-- <button type='button' class='btn btn-next btn-fill btn-success ' name='next'>Siguiente</button> --}}
		                                <input type='submit' name="form-1" form="formulario" class='btn btn-fill btn-success ' value='Envíar código de recuperación' />
		                            </div>

		                            <div class="clearfix"></div>
		                        </div>
		                    </form>

		                    <form action="{{ url('check-code') }}" method="POST" id="formulario-2" class="hidden" enctype="multipart/form-data">
		                    	{{csrf_field()}}

		                    	<div class="wizard-header">
		                    		<img src="{{url('/logo-mem.jpg')}}" style="width: 40%;">
									{{-- <h5>This information will let us know more about you.</h5> --}}
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a style="cursor: default;" data-toggle="tab">Recuperar Contraseña</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content" style="min-height: 300px">
		                            <div class="tab-pane active" id="about-2">
		                              <div class="row">
		                                	<h4 class="info-text"> Ingresa el código recibido</h4>
		                                	{{-- <div class="col-sm-4 col-sm-offset-1">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="{{url('/frontend')}}/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
		                                            	<input type="file" name="user_image" id="wizard-picture">
		                                        	</div>
		                                        	<h6>Selecciona una foto</h6>
		                                    	</div>
		                                	</div> --}}
		                                	<div class="col-sm-6 col-sm-offset-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Código</label>
			                                          <input name="code" type="text" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">

		                        	<h3 class="wizard-title text-center">
		                        	   <small>¿Ya tienes una cuenta? <a href="{{url('/')}}">{{-- <i class="material-icons">arrow_back</i> --}} Iniciar Sesión</a></small>
		                        	</h3>

		                        	<br>


		                            <div class="-pull-right" style="text-align: center;">
		                                {{-- <button type='button' class='btn btn-next btn-fill btn-success ' name='next'>Siguiente</button> --}}
		                                <input type='submit' name="form-2" form="formulario-2" class='btn btn-fill btn-success ' value='Ingresar' />
		                            </div>

		                            {{-- <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default ' name='previous' value='Anterior' />
		                            </div> --}}
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>

		                    <form action="{{ url('change-password') }}" method="POST" id="formulario-3" class="hidden" enctype="multipart/form-data">
		                    	{{csrf_field()}}
		               			 <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                    		<img src="{{url('/logo-mem.jpg')}}" style="width: 40%;">
									{{-- <h5>This information will let us know more about you.</h5> --}}
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a style="cursor: default;" data-toggle="tab">Recuperar Contraseña</a></li>
			                            {{-- <li><a href="#account" data-toggle="tab">Servicios</a></li> --}}
			                            {{-- <li><a href="#address" data-toggle="tab">Punto y Servicios</a></li> --}}
			                        </ul>
								</div>

		                        <div class="tab-content" style="min-height: 300px">
		                            <div class="tab-pane active" id="about-2">
		                              <div class="row">
		                                	<h4 class="info-text"> Cambia tu contraseña</h4>
		                                	{{-- <div class="col-sm-4 col-sm-offset-1">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="{{url('/frontend')}}/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
		                                            	<input type="file" name="user_image" id="wizard-picture">
		                                        	</div>
		                                        	<h6>Selecciona una foto</h6>
		                                    	</div>
		                                	</div> --}}
		                                	<input type="hidden" name="user_id" id="user_id">
		                                	<div class="col-sm-6 col-sm-offset-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Password</label>
			                                          <input name="password" type="password" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>

		                                	<div class="col-sm-6 col-sm-offset-3">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Repetir contraseña</label>
			                                          <input name="password_confirmation" type="password" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">

		                        	<h3 class="wizard-title text-center">
		                        	   <small>¿Ya tienes una cuenta? <a href="{{url('/')}}">{{-- <i class="material-icons">arrow_back</i> --}} Iniciar Sesión</a></small>
		                        	</h3>

		                        	<br>


		                            <div class="-pull-right" style="text-align: center;">
		                                {{-- <button type='button' class='btn btn-next btn-fill btn-success ' name='next'>Siguiente</button> --}}
		                                <input type='submit' name="form-3" form="formulario-3" class='btn btn-fill btn-success ' value='Ingresar' />
		                            </div>

		                            {{-- <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default ' name='previous' value='Anterior' />
		                            </div> --}}
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    {{-- <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>
	        </div>
	    </div> --}}
	</div>

</body>
	<!--   Core JS Files   -->
    <script src="{{url('/frontend')}}/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="{{url('/frontend')}}/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="{{url('/frontend')}}/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="{{url('/frontend')}}/assets/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="{{url('/frontend')}}/assets/js/jquery.validate.min.js"></script>

	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCysLSKrqHKdBaYLdEP6wqmBFNR-85sMHs&libraries=places'></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		var randomColor = Math.floor(Math.random()*99999).toString();

		$('#codigo').val(randomColor);

		localStorage.setItem('codice',randomColor)

		$('#formulario,#formulario-2,#formulario-3').submit(function (e) {
			e.preventDefault();

			var formData = new FormData($(this)[0]);

			var form = $(this)

			console.log(formData);

			stop = 0;

			let title = "";

			$.each($(this).find('[required]'), function(index, val) {
				if (!$(this).val()) {
					stop++;
				}
			});

			if (stop > 0) {
				return Swal.fire({
				  title:'Rellene los campos obligatorios',
				  icon:'error'
				});
			}

			if ($(this).find('[name="form-2"]').length) {

				console.log('form-2')

				if ($(this).find('[name="code"]').val() == randomColor) {
					title = "Código verificado, ingrese su nueva contraseña";
					type = "success";

					$('#formulario-2').addClass('hidden');
					$('#formulario-3').removeClass('hidden');
				}else{
					title = "El código ingresado no es correcto";
					type = "error";
				}

				Swal.fire({
				  title:title,
				  icon:type
				});

				return false;
			}

			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				contentType: false,
				processData: false,
				data: formData,
			})
			.done(function(data) {

				if ($(form).find('[name="form-1"]').length) {
					
					$('[name="user_id"]').val(data.id);
					title = "Código enviado a su correo, por favor revisar y a continuación introducir en el formulario.";

					$('#formulario').addClass('hidden');
					$('#formulario-2').removeClass('hidden');
				}

				if ($(form).find('[name="form-3"]').length) {
					title = "La contraseña ha sido cambiada, por favor inicie sesión";

					setTimeout(()=>{
						window.open('{{url('/')}}','_self');
					},3000);
				}
				Swal.fire({
				  title:title,
				  icon:'success'
				});

			})
			.fail(function(e) {
				let err = e.responseJSON.errors;

				let html = "";
				for(let i in err){
					html+=err[i]+"<br>";
				}

				Swal.fire({
				  html:"<span style='font-size:18px'>"+html+"</span>",
				  icon:'error'
				});
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	</script>

</html>

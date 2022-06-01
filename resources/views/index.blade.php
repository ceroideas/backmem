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
		                    <form action="{{ url('points-front') }}" method="POST" id="formulario" enctype="multipart/form-data">
		                    	{{csrf_field()}}
		               			 <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                    		<img src="{{url('/logo-mem.jpg')}}" style="width: 40%;">
		                        	<h3 class="wizard-title">
		                        	   Construye tu perfil <br>
		                        	   {{-- <small><a href="{{url('customer')}}">Si ya tienes un acceso has click aquí</a></small> --}}
		                        	</h3>
									{{-- <h5>This information will let us know more about you.</h5> --}}
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">Perfil de cliente</a></li>
			                            {{-- <li><a href="#account" data-toggle="tab">Servicios</a></li> --}}
			                            <li><a href="#address" data-toggle="tab">Punto y Servicios</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                              <div class="row">
		                                	<h4 class="info-text"> Información Básica</h4>
		                                	<div class="col-sm-4 col-sm-offset-1">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="{{url('/frontend')}}/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
		                                            	<input type="file" name="user_image" id="wizard-picture">
		                                        	</div>
		                                        	<h6>Selecciona una foto</h6>
		                                    	</div>
		                                	</div>
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Email</label>
			                                          <input name="email" type="email" class="form-control" required>
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Contraseña</label>
													  <input name="password" type="password" class="form-control" required>
													</div>
												</div>
		                                	</div>
		                                	<div class="col-sm-10 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
													<div class="form-group label-floating">
			                                            <label class="control-label">Nombre completo</label>
			                                            <input name="name" type="text" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="address">

		                            	<div style="text-align: center;">
			                            	<button class="btn btn-sm btn-info selectable" data-toggle="tab" data-target="#escribir-datos">Escribir Datos del Punto manualmente</button>
			                            	<button class="btn btn-sm btn-info selectable" data-toggle="tab" data-target="#subir-archivo">Subir Archivo de Excel</button>
		                            	</div>

		                            	<div class="tab-content">
		                            		<div class="tab-pane" id="escribir-datos">

				                                <div class="row">
				                                    <div class="col-sm-12">
				                                        <h4 class="info-text"> Datos del Punto </h4>
				                                    </div>

				                                    <div class="col-sm-10 col-sm-offset-1">
				                                    	<div class="picture-container">
				                                        	<div class="picture" style="border-radius: 8px;">
		                                        				<img src="{{url('/frontend')}}/assets/img/default-image.png" class="picture-src" id="wizardPicturePreview1" title=""/>
				                                            	<input type="file" name="point_image" id="wizard-picture-2">
				                                        	</div>
				                                        	<h6>Imagen de referencia</h6>
				                                    	</div>
				                                	</div>

				                                    <div class="col-sm-10 col-sm-offset-1">
			                                        	<div class="form-group -label-floating">
			                                        		<label class="control-label">Dirección</label>
			                                    			<input autocomplete="off" id="autocomplete" type="text" class="form-control">
			                                        	</div>
				                                    </div>
				                                    <div class="col-sm-5 col-sm-offset-1">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Calle</label>
				                                            <input name="street" type="text" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-5">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Código Postal</label>
				                                            <input name="cp" type="text" class="form-control" required>
				                                        </div>
				                                    </div>
				                                    <div class="col-sm-5 col-sm-offset-1">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Entidad</label>
				                                            <input name="entity" type="text" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-5">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Municipio o Alcaldía</label>
				                                            <input name="municipality" type="text" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-5 col-sm-offset-1">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Colonia</label>
				                                            <input name="colony" type="text" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-5">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Nº Exterior</label>
				                                            <input name="n_exterior" type="number" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-5 col-sm-offset-1">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Nº Interior</label>
				                                            <input name="n_interior" type="number" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-5">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Responsable</label>
				                                            <input name="responsable" type="text" class="form-control" required>
				                                        </div>
				                                    </div>

				                                    <div class="col-sm-12">
				                                    	<br>
				                                        <h4 class="info-text"> Servicios </h4>
				                                    </div>

				                                    @php
				                                    	$services = App\Models\Service::where('only_admin',null)->orderBy('order','desc')->get();
				                                    @endphp

				                                    <div class="col-sm-10 col-sm-offset-1">
				                                    	<div class="row">
				                                    		@foreach ($services as $s)
					                                    		<div class="col-sm-6">
					                                    			<div class="form-group label-floating">
																		<label class="control-label">{{$s->label}}</label>
																		@switch($s->type)
																		    @case('text')

																		    	<input type="text" data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control" {{-- placeholder="{{$s->placeholder}}" --}}>
																		        
																		        @break

																		    @case('number')

																		    	<input type="number" data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control" {{-- placeholder="{{$s->placeholder}}" --}}>
																		        
																		        @break

																		    @case('select')

																		    	<select data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control">
																		    		@foreach ($s->options as $opt)
																		    			<option>{{$opt->value}}</option>
																		    		@endforeach
																		    	</select>
																		        
																		        @break
																		
																		@endswitch
																		
																	</div>
					                                    		</div>
				                                    		@endforeach
				                                    	</div>
				                                    </div>

				                                    <input name="lat" type="hidden">
				                                    <input name="lng" type="hidden">
				                                    <input name="color" type="hidden">
				                                    {{-- <div class="col-sm-3">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Street Number</label>
				                                            <input type="text" class="form-control">
				                                        </div>
				                                    </div>
				                                    <div class="col-sm-5 col-sm-offset-1">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">City</label>
				                                            <input type="text" class="form-control">
				                                        </div>
				                                    </div> --}}
				                                    {{-- <div class="col-sm-5">
				                                        <div class="form-group label-floating">
				                                            <label class="control-label">Country</label>
			                                            	<select name="country" class="form-control">
																<option disabled="" selected=""></option>
			                                                	<option value="Afghanistan"> Afghanistan </option>
			                                                	<option value="Albania"> Albania </option>
			                                                	<option value="Algeria"> Algeria </option>
			                                                	<option value="American Samoa"> American Samoa </option>
			                                                	<option value="Andorra"> Andorra </option>
			                                                	<option value="Angola"> Angola </option>
			                                                	<option value="Anguilla"> Anguilla </option>
			                                                	<option value="Antarctica"> Antarctica </option>
			                                                	<option value="...">...</option>
			                                            	</select>
				                                        </div>
				                                    </div> --}}
				                                </div>
		                            		</div>

		                            		<div class="tab-pane" id="subir-archivo">
				                            	<div class="row">
				                            		<div class="col-sm-12">
				                            			
				                            			<div class="form-group">
								                            <label>Seleccione el archivo a cargar, el archivo debe ser el mismo que ha sido suministrado por MEM</label>
								                            <input type="file" class="form-control" name="excel" accept=".xlsx,.csv,.xls">
								                        </div>

				                            		</div>
				                            	</div>
		                            			
		                            		</div>
		                            	</div>

		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <button type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next'>Siguiente</button>
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Finalizar' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />

		                                <a class='btn btn-fill btn-next1 btn-info btn-wd' href="{{url('/')}}">Volver</a>
		                            </div>
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
		var randomColor = Math.floor(Math.random()*16777215).toString(16);

		$('[name="color"]').val('#'+randomColor);
		$('#formulario').submit(function (e) {
			e.preventDefault();

			var formData = new FormData($(this)[0]);

			console.log(formData);

			let services = [];
			let stop = 0;

			$.each($('[required]'), function(index, val) {
				if (!$(this).val()) {
					stop++;
				}
			});

			if (stop > 0 && $('#escribir-datos').hasClass('active')) {
				return Swal.fire({
				  title:'Rellene los campos obligatorios',
				  icon:'error'
				});
			}

			if ($('#subir-archivo').hasClass('active')) {
				if ($('[name="excel"]').val() == "") {
					return Swal.fire({
					  title:'Seleccione un archivo para cargarlo',
					  icon:'error'
					});
				}
			}

			if (!$('#subir-archivo').hasClass('active') && !$('#escribir-datos').hasClass('active')) {
				return Swal.fire({
				  title:'Seleccione un método de subida de puntos',
				  icon:'error'
				});
			}

			let arr = Array.from($('.question'));

			for (let i of arr) {
				let tmp = {};
				tmp.key = $(i).data('key');
				tmp.title = $(i).data('title');
				tmp.value = $(i).val();

				services.push(tmp);
			}
			
			formData.append('services',JSON.stringify(services));

			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				contentType: false,
				processData: false,
				data: formData,
			})
			.done(function() {
				Swal.fire({
				  title:'Cliente guardado!',
				  icon:'success'
				});

				setTimeout(()=>{
					location.reload();
				},3000)

			})
			.fail(function(e) {
				let err = e.responseJSON.errors;

				let html = "";
				for(let i in err){
					html+=err[i]+"<br>";
				}

				Swal.fire({
				  html:html,
				  icon:'error'
				});
			})
			.always(function() {
				console.log("complete");
			});
			
		});
		function initAutocomplete()
		{
		    var geocoder = new google.maps.Geocoder;
		    
		    var input = document.querySelector('#autocomplete');
		    var countryRestrict = {'country': ['mx']};
		    var options = {
		      types: ['geocode']
		    };

		   var autocomplete = new google.maps.places.Autocomplete(input, options);

		    autocomplete.setComponentRestrictions(
		          {'country': ['mx']});

		    let fillInAddress = ()=> {
		      // Get the place details from the autocomplete object.
		      var arr = autocomplete.getPlace();
		      console.log(arr);

		      latlng = {lat:arr.geometry.location.lat(),lng:arr.geometry.location.lng()};

		      geocoder.geocode({'location': latlng}, (results, status) => {
		          if (status === 'OK') {
		            if (results[0]) {
		              
		              // address = results[0].formatted_address;
		              
		              getAddress(results,arr);
		            } else {
		              window.alert('No results found');
		            }
		          } else {
		            window.alert('Geocoder failed due to: ' + status);
		          }
		        });

		    }

		    autocomplete.addListener('place_changed', fillInAddress);
		}

		function getAddress(arr,a)
  		{
		    var address = {};
		    address.lat = a.geometry.location.lat();
		    address.lng = a.geometry.location.lng();
		    console.log(arr);
		    if (arr.length) {

		      for (var i = 0; i < arr[0].address_components.length; i++) {

		          let comp = arr[0].address_components[i];
		          
		          var addressType = comp.types[0];

		          console.log(comp);

		          if (addressType) {
		            if (addressType == 'route') {
		              address.street = comp.long_name; // calle

		            }else if(addressType == 'locality'){
		              address.municipality = comp.long_name; // municipio

		            }else if(addressType == 'country'){
		              address.country = comp.long_name; // pais

		            }else if(addressType == 'postal_code'){
		              address.cp = comp.long_name; // codigo postal

		            }else if(addressType == 'political'){
		              address.colony = comp.long_name; // colonia

		            }else if(addressType == 'administrative_area_level_1'){
		              address.entity = comp.long_name; // entidad
		              
		            }
		          }
		      }
		    }

		    for (var i in address) {
		    	$('[name="'+i+'"]').val(address[i]).trigger('change');
		    }

		}

		initAutocomplete();

		$('.selectable').click(function (e) {
			e.preventDefault();

			$.each($('.selectable'), function(index, val) {
				 $(this).removeClass('btn-primary');
				 $(this).addClass('btn-info');
			});

			$(this).removeClass('btn-info');
			$(this).addClass('btn-primary');
		});
	</script>

</html>

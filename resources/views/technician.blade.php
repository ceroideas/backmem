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

	<link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" />
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
		                    {{-- <form action="{{ url('points-front') }}" method="POST" id="formulario" enctype="multipart/form-data"> --}}
		                    	{{csrf_field()}}
		               			 <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                    		<img src="{{url('/logo-mem.jpg')}}" style="width: 40%;">
		                        	<h3 class="wizard-title">
		                        	   {{-- <div class="picture-container">
	                                    	<div class="picture">
	                            				<img src="{{url('uploads/customers',Auth::user()->customer->image)}}" class="picture-src" title=""/>
	                                    	</div>
	                                   </div> --}}
		                        	   Hola {{Auth::user()->name}} ({{Auth::user()->email}}) <br>

		                        	   <small><a href="{{url('logout')}}">Salir</a></small>
		                        	</h3>
									{{-- <h5>This information will let us know more about you.</h5> --}}
		                    	</div>
		                    	@php
		                    		$customer = null;
		                    		if (Auth::user()->customer) {
		                    			$customer = Auth::user()->customer;
		                    		}
		                    		if (session('customer')) {
		                    			$customer = session('customer');
		                    		}
		                    	@endphp
								@if ($customer)
									<div class="wizard-navigation">
										<ul>
											@if (Auth::user()->role_id == 0)
				                            	<li><a href="#about" data-toggle="tab">Puntos del cliente {{$customer->name}}</a></li>
				                            @else
				                            	<li><a href="#about" data-toggle="tab">Tus puntos</a></li>
											@endif
				                            {{-- <li><a href="#account" data-toggle="tab">Servicios</a></li> --}}
				                            {{-- <li><a href="#address" data-toggle="tab">Punto y Servicios</a></li> --}}
				                        </ul>
									</div>

			                        <div class="tab-content">
			                            <div class="tab-pane" id="about">
			                              <div class="row">
			                              		<div class="panel">
			                              			<div class="panel-body" style="padding-top: 0;">
			                              				
					                                	<h4 class="info-text"> Listado de Puntos</h4>
					                                	
					                                	<div id="table-points">
					                                		@include('table', ['customer' => $customer])
					                                	</div>
			                              			</div>
			                              		</div>

			                            	</div>

			                            	<input type='button' href="#address" data-toggle="tab" class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Añadir punto' style="margin: 0; margin-top: 20px;bottom: -10px;"/>

			                            	<input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' data-toggle="modal" href="#import-modal" value='Subir excel' style="margin: 0; margin-top: 20px;bottom: -10px; float: right;"/>
			                            </div>
			                            <div class="tab-pane" id="address">
			                            	<form action="{{ url('savepoint-front') }}" method="POST" id="formulario" enctype="multipart/form-data">
			                            		{{csrf_field()}}
			                            		<input type="hidden" name="customer_id" value="{{$customer->id}}">
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
					                                    			<div class="form-group label-floating-">
																		<label class="control-label">{{$s->label}}</label>
																		@switch($s->type)
																		    @case('text')

																		    	<input type="text" data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control" placeholder="{{$s->placeholder}}">
																		        
																		        @break

																		    @case('text-masked')

																		    	<input type="text" data-key="{{$s->name}}" data-title="{{$s->label}}" class="masked question form-control" placeholder="{{$s->placeholder}}">
																		        
																		        @break

																		    @case('number')

																		    	<input type="number" data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control" placeholder="{{$s->placeholder}}">
																		        
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
				                                    {{-- <input name="color" type="hidden"> --}}
				                                </div>

				                                <div class="wizard-footer">
						                            <div class="pull-right">
						                                {{-- <button type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next'>Siguiente</button> --}}
						                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Finalizar' style="margin: 0; margin-top: 20px;bottom: -10px; right: -14px;"/>
						                            </div>

						                            <div class="pull-left">
						                                <input href="#about" data-toggle="tab" type='button' class='btn btn-fill btn-default btn-wd' name='previous' value='Anterior' style="margin: 0; margin-top: 20px;bottom: -10px; left: -14px;"/>
						                            </div>
						                            <div class="clearfix"></div>
						                        </div>
					                    	</form>
			                            </div>
			                        </div>
			                    @else

			                    	<div class="wizard-navigation">
										<ul>
				                            <li><a href="#about" data-toggle="tab">Para continuar, seleccione un Cliente</a></li>
				                            {{-- <li><a href="#account" data-toggle="tab">Servicios</a></li> --}}
				                            {{-- <li><a href="#address" data-toggle="tab">Punto y Servicios</a></li> --}}
				                        </ul>
									</div>

			                        <div class="tab-content" style="min-height: fit-content;">

			                        	<div class="tab-pane" id="about">
				                        	<form action="{{url('select-customer')}}" method="POST">
				                        		{{csrf_field()}}
						                    	<select name="id" class="form-control" required>
						                    		<option value="" selected disabled></option>
						                    		@foreach (App\Models\Customer::all() as $c)
						                    			<option value="{{$c->id}}">{{$c->name}}</option>
						                    		@endforeach
						                    	</select>

						                    	<button type="submit" class="btn btn-success">Aceptar</button>

				                        	</form>
			                        	</div>

				                    </div>

								@endif
		                        {{-- <div class="wizard-footer">
		                            <div class="pull-right">
		                                <button type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next'>Siguiente</button>
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Finalizar' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div> --}}
		                    {{-- </form> --}}
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

	<div class="modal fade" id="import-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					Subir excel suministrado por MEM
				</div>
				<div class="modal-body">
					<form action="{{url('excel-import')}}" method="POST" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label>Seleccione el archivo a cargar</label>
                            <input type="file" class="form-control" name="excel" required accept=".xlsx,.csv,.xls">
                        </div>

                        <button class="btn btn-success" type="submit">Enviar</button>
                    </form>
                    
				</div>
			</div>
		</div>
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

	<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

	<script>

		@php
			use Illuminate\Support\Facades\Session;
		@endphp

		@if (session('error_sheet'))
			
			Swal.fire({
			  title:"Ha ocurrido un error",
			  text: '{{session('error_sheet')}}',
			  icon:'error'
			});

			@php
				Session::forget('error_sheet');
			@endphp

		@endif
		var randomColor = Math.floor(Math.random()*16777215).toString(16);

		$('[name="color"]').val('#'+randomColor);

		let sendForm = async function (e) {
			e.preventDefault();

			console.log('hola');

			let req = Array.from($(this).find('[required]'));

			let direccion = $(this)[0].street.value+', '+$(this)[0].colony.value+', '+$(this)[0].municipality.value+', '+$(this)[0].municipality.value+', '+$(this)[0].cp.value;

			var geocoder = new google.maps.Geocoder;

			await geocoder
		    .geocode({ address: direccion })
		    .then(({ results }) => {
		      $(this)[0].lat.value = results[0].geometry.location.lat();
		      $(this)[0].lng.value = results[0].geometry.location.lng();
		    })
		    .catch((e) =>
		      alert("Geocode was not successful for the following reason: " + e)
		    );

			// return console.log(direccion);

			for (let i of req){
				$(i).trigger('change');
				if (!i.value) {
					Swal.fire({
					  title:"Por favor, complete todos los campos requeridos",
					  icon:'error'
					});
					return false;
				}
			}

			var formData = new FormData($(this)[0]);

			console.log(formData);

			let services = [];

			let arr = Array.from($(this).find('.question'));

			for (let i of arr) {
				let tmp = {};
				tmp.key = $(i).data('key');
				tmp.title = $(i).data('title');
				tmp.value = $(i).val();

				services.push(tmp);
			}
			
			formData.append('services',JSON.stringify(services));

			let form = $(this)[0];

			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				contentType: false,
				processData: false,
				data: formData,
			})
			.done(function(data) {
				Swal.fire({
				  title:data.message,
				  icon:'success'
				});

				if (data.view) {
					form.reset();
					$('.modal').modal('hide');
					setTimeout(()=>{
						$('[name="previous"]').click();
						$('#table-points').html(data.view);
						$('#formulario, .formulario-edit').unbind('submit', sendForm);
						$('#formulario, .formulario-edit').submit(sendForm);

						$(document).ready( function () {
						    $('#myTable').DataTable();
						});
						
					},500)

				}else{
					setTimeout(()=>{
						location.reload();
					},3000)
				}

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
			
		};

		$('#formulario, .formulario-edit').submit(sendForm);
		
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

		$(document).ready( function () {
		    $('#myTable').DataTable();
		});

		initAutocomplete();
	</script>

	<script>

		function createMasked()
		{
			let ccNumberInput = document.querySelector('.masked'),
				ccNumberPattern = /^\d{0,12}$/g,
				ccNumberSeparator = " ",
				ccNumberInputOldValue,
				ccNumberInputOldCursor,
				
				mask = (value, limit, separator) => {
					var output = [];
					for (let i = 0; i < value.length; i++) {
						if ( i !== 0 && i % limit === 0) {
							output.push(separator);
						}
						
						output.push(value[i]);
					}
					
					return output.join("");
				},
				unmask = (value) => value.replace(/[^\d]/g, ''),
				checkSeparator = (position, interval) => Math.floor(position / (interval + 1)),
				ccNumberInputKeyDownHandler = (e) => {
					console.log('masked')
					let el = e.target;
					ccNumberInputOldValue = el.value;
					ccNumberInputOldCursor = el.selectionEnd;
				},
				ccNumberInputInputHandler = (e) => {
					console.log('masked')
					let el = e.target,
							newValue = unmask(el.value),
							newCursorPosition;
					
					if ( newValue.match(ccNumberPattern) ) {
						newValue = mask(newValue, 3, ccNumberSeparator);
						
						newCursorPosition = 
							ccNumberInputOldCursor - checkSeparator(ccNumberInputOldCursor, 3) + 
							checkSeparator(ccNumberInputOldCursor + (newValue.length - ccNumberInputOldValue.length), 3) + 
							(unmask(newValue).length - unmask(ccNumberInputOldValue).length);
						
						el.value = (newValue !== "") ? newValue : "";
					} else {
						el.value = ccNumberInputOldValue;
						newCursorPosition = ccNumberInputOldCursor;
					}
					
					el.setSelectionRange(newCursorPosition, newCursorPosition);
				};

			ccNumberInput.addEventListener('keydown', ccNumberInputKeyDownHandler);
			ccNumberInput.addEventListener('input', ccNumberInputInputHandler);
		}

		setTimeout(()=>{
			createMasked();
		},1000)
	</script>

</html>

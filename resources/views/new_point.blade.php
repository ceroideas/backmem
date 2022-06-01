@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Puntos</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Crear Punto</li>
            </ol>
        </div>
        {{-- <div class="col-md-6 col-4 align-self-center">
            <button class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Create</button>
        </div> --}}
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Crear punto</h4>
                    <div class="m-t-40">
                        
                        <form action="{{url('admin/points')}}" method="POST" id="formulario" enctype="multipart/form-data">
                            {{csrf_field()}}

                        	<div class="row">

                        		<div class="col-sm-12">
                                	<div class="form-group -label-floating">
                                		<label class="control-label-">Dirección</label>
                            			<input autocomplete="off" id="autocomplete" type="text" class="form-control">
                                	</div>
                                </div>

                        		<div class="col-sm-6">
		                        	<div class="form-group">
		                        		<label>Cliente</label>
		                        		<select class="form-control" name="customer_id" id="">
		                        				<option value=""></option>
		                        			@foreach ($customers as $c)
		                        				<option value="{{$c->id}}">{{$c->name}}</option>
		                        			@endforeach
		                        		</select>
		                        	</div>
                        		</div>

								<div class="col-sm-6">
									<div class="form-group">
										<label>Calle</label>
										<input type="text" class="form-control" name="street">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Nº Exterior</label>
										<input type="number" class="form-control" name="n_exterior">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Nº Interior</label>
										<input type="number" class="form-control" name="n_interior">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Colonia</label>
										<input type="text" class="form-control" name="colony">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Código Postal</label>
										<input type="number" class="form-control" name="cp">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Entidad</label>
										<input type="text" class="form-control" name="entity">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Municipio o alcaldía</label>
										<input type="text" class="form-control" name="municipality">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Responsable</label>
										<input type="text" class="form-control" name="responsable">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Imagen de referencia</label>
										<input type="file" class="form-control" name="point_image">
									</div>
								</div>

								<div class="col-sm-6">
		                        	<div class="form-group">
		                        		<label>Status</label>
		                        		<select class="form-control" name="status" id="">
		                        			<option value=""></option>
		                        			<option value="1">Visita a sitio</option>
		                        			<option value="2">Medición servicios interiores</option>
		                        			<option value="3">Medición legal</option>
		                        			<option value="4">Levantamiento</option>
		                        			<option value="5">Estudios y reportes</option>
		                        		</select>
		                        	</div>
                        		</div>

                        		<div class="col-sm-6">
		                        	<div class="form-group">
		                        		<label>Nivel de cumplimiento</label>
		                        		<select class="form-control" name="compliance" id="">
		                        			<option value=""></option>
		                        			<option value="1">Cumple con CR</option>
		                        			<option value="2">No cumple con CR</option>
		                        		</select>
		                        	</div>
                        		</div>

                        		<div class="col-sm-12">
									<div class="form-group">
										<label>Problemática</label>
										<textarea class="form-control" rows="4" name="troublesome"></textarea>
									</div>
								</div>

								<div class="col-sm-12">
									<hr>

									<h3>Servicios</h3>
								</div>

									
									@foreach ($services as $s)
								<div class="col-sm-6">
										
										<div class="form-group">
											<label>{{$s->label}}</label>
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
											    		<option selected="" disabled=""></option>
											    		@foreach ($s->options as $opt)
											    			<option>{{$opt->value}}</option>
											    		@endforeach
											    	</select>
											        
											        @break
											
											@endswitch
											
										</div>

								</div>
									@endforeach


								<div class="col-sm-12">
									<hr>

									<h3>Proceso operativo</h3>
								</div>


									{{-- @php
										function checkValueProcess($process,$key)
										{
											$process = json_decode($process,true);
											if (isset($process)) {
												foreach ($process as $s) {
													if ($s['key'] == $key) {
														return $s['value'];
													}
												}
											}
										}
									@endphp --}}
									
									@foreach ($sections as $s)
											<div class="col-sm-12">
												<h4>{{$s->name}}</h4>
											</div>

										@foreach ($s->inputs as $p)
											<div class="col-sm-6">
													
													<div class="form-group">
														<label>{{$p->label}}</label>
														@switch($p->type)
														    @case('text')

														    	<input type="text" data-key="{{$p->name}}" data-title="{{$p->label}}" class="processes form-control" placeholder="{{$p->placeholder}}">
														        
														        @break

														    @case('text-masked')

														    	<input type="text" data-key="{{$p->name}}" data-title="{{$p->label}}" class="masked processes form-control" placeholder="{{$s->placeholder}}">
														        
														        @break

														    @case('number')

														    	<input type="number" data-key="{{$p->name}}" data-title="{{$p->label}}" class="processes form-control" placeholder="{{$p->placeholder}}">
														        
														        @break

														    @case('select')

														    	<select data-key="{{$p->name}}" data-title="{{$p->label}}" class="processes form-control">
														    		<option selected="" disabled=""></option>
														    		@foreach ($p->options as $opt)
														    			<option>{{$opt->value}}</option>
														    		@endforeach
														    	</select>
														        
														        @break
														
														@endswitch
														
													</div>

											</div>
										@endforeach

										<hr>
									@endforeach

									<input name="lat" type="hidden">
			                        <input name="lng" type="hidden">



                        		<div class="col-sm-12">
                        			<button type="submit" class="btn btn-success">Guardar</button>
                        		</div>
                        		

                        	</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

	{{-- /**/ --}}
</div>

@endsection

@section('scripts')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCysLSKrqHKdBaYLdEP6wqmBFNR-85sMHs&libraries=places'></script>
<script>
	$('#formulario').submit(function (e) {
		e.preventDefault();

		var formData = new FormData($(this)[0]);

		console.log(formData);

		let services = [];
		let processes = [];

		let arr = Array.from($('.question'));
		let prc = Array.from($('.processes'));

		for (let i of arr) {
			let tmp = {};
			tmp.key = $(i).data('key');
			tmp.title = $(i).data('title');
			tmp.value = $(i).val();

			services.push(tmp);
		}

		for (let i of prc) {
			let tmp = {};
			tmp.key = $(i).data('key');
			tmp.title = $(i).data('title');
			tmp.value = $(i).val();

			processes.push(tmp);
		}
		
		formData.append('services',JSON.stringify(services));
		formData.append('processes',JSON.stringify(processes));

		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			contentType: false,
			processData: false,
			data: formData,
		})
		.done(function(data) {
			Swal.fire({
			  title:'Punto guardado!',
			  icon:'success'
			});

			setTimeout(()=>{
				window.open(data.url);
			},2000)

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

	$('select.question').on('change', function(event) {
		event.preventDefault();
		console.log($(this))
		if ($(this).val() == 'Otro') {

			let key = $(this).data('key');
			let title = $(this).data('title');

			$(this).parent('.form-group').append('<input type="text" data-key="'+key+'" data-title="'+title+'" value="" class="question form-control other" placeholder="Especifique">');
		}else{
			$(this).parent('.form-group').find('.other').remove();
		}
	});

	$('select.processes').on('change', function(event) {
		event.preventDefault();
		console.log($(this))
		if ($(this).val() == 'Otro') {

			let key = $(this).data('key');
			let title = $(this).data('title');

			$(this).parent('.form-group').append('<input type="text" data-key="'+key+'" data-title="'+title+'" value="" class="processes form-control other" placeholder="Especifique">');
		}else{
			$(this).parent('.form-group').find('.other').remove();
		}
	});

	initAutocomplete();
</script>
@if ($services->where('type','text-masked')->count())
<script>
	
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
		let el = e.target;
		ccNumberInputOldValue = el.value;
		ccNumberInputOldCursor = el.selectionEnd;
	},
	ccNumberInputInputHandler = (e) => {
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

</script>
@endif	
@endsection

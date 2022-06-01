@extends('layout')

@section('content')

<style>
	.other {
		margin-top: 8px;
	}
</style>

<link href="{{ asset('/dropzone.css') }}" rel="stylesheet">

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Puntos</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Editar Punto</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="{{ url('admin/'.$p->id,'gathering') }}" style="margin-left: 8px;" class="btn btn-xs float-right hidden-sm-down btn-warning">Ir a Levantamiento</a>
            <a href="{{ url('admin/'.$p->id,'report') }}" class="btn btn-xs float-right hidden-sm-down btn-success">Ir a Reportear</a>
        </div>
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
        	<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item" role="presentation">
			    <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Principal</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" id="medicion-tab" data-toggle="tab" href="#medicion" role="tab" aria-controls="medicion" aria-selected="false">Medición de servicios interiores</a>
			  </li>
			</ul>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar punto</h4>
                    <div class="m-t-40">
                            <div class="tabbable">
                            	
                            	<div class="tab-content">
                            		
                            		<div class="tab-pane fade show active" id="main">

                            			<form action="{{url('admin/points',$p->id)}}" method="POST" id="formulario" enctype="multipart/form-data">
			                            {{csrf_field()}}

			                            <input type="hidden" id="allGallery" name="allGallery">

                            			<div class="row">

			                        		<div class="col-sm-6">
					                        	<div class="form-group">
					                        		<label>Cliente</label>
					                        		<select class="form-control" name="customer_id" id="">
					                        				<option value=""></option>
					                        			@foreach ($customers as $c)
					                        				<option {{$c->id == $p->customer_id ? 'selected' : ''}} value="{{$c->id}}">{{$c->name}}</option>
					                        			@endforeach
					                        		</select>
					                        	</div>
			                        		</div>


											<div class="col-sm-6">
												<div class="form-group">
													<label>Calle</label>
													<input type="text" class="form-control" name="street" value="{{$p->street}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Nº Exterior</label>
													<input type="number" class="form-control" name="n_exterior" value="{{$p->n_exterior}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Nº Interior</label>
													<input type="number" class="form-control" name="n_interior" value="{{$p->n_interior}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Colonia</label>
													<input type="text" class="form-control" name="colony" value="{{$p->colony}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Código Postal</label>
													<input type="number" class="form-control" name="cp" value="{{$p->cp}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Entidad</label>
													<input type="text" class="form-control" name="entity" value="{{$p->entity}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Municipio o Alcaldía</label>
													<input type="text" class="form-control" name="municipality" value="{{$p->municipality}}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Responsable</label>
													<input type="text" class="form-control" name="responsable" value="{{$p->responsable}}">
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
					                        			<option {{$p->status == 1 ? 'selected' : ''}} value="1">Visita a sitio</option>
					                        			<option {{$p->status == 2 ? 'selected' : ''}} value="2">Medición servicios interiores</option>
					                        			<option {{$p->status == 3 ? 'selected' : ''}} value="3">Medición legal</option>
					                        			<option {{$p->status == 4 ? 'selected' : ''}} value="4">Levantamiento</option>
					                        			<option {{$p->status == 5 ? 'selected' : ''}} value="5">Estudios y reportes</option>
					                        		</select>
					                        	</div>
			                        		</div>

			                        		<div class="col-sm-6">
					                        	<div class="form-group">
					                        		<label>Nivel de cumplimiento</label>
					                        		<select class="form-control" name="compliance" id="">
					                        			<option value=""></option>
					                        			<option {{$p->compliance == 1 ? 'selected' : ''}} value="1">Cumple con CR</option>
					                        			<option {{$p->compliance == 2 ? 'selected' : ''}} value="2">No cumple con CR</option>
					                        		</select>
					                        	</div>
			                        		</div>

			                        		<div class="col-sm-12">
												<div class="form-group">
													<label>Problemática</label>
													<textarea class="form-control" rows="4" name="troublesome">{{$p->troublesome}}</textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<hr>

												<h3>Servicios</h3>
											</div>


												@php
													function checkValue($services,$key)
													{
														$services = json_decode($services,true);
														if (isset($services)) {
															foreach ($services as $s) {
																if ($s['key'] == $key) {
																	return $s['value'];
																}
															}
														}
													}
												@endphp
												
												@foreach ($services as $s)
													<div class="col-sm-6">
															
															<div class="form-group">
																<label>{{$s->label}}</label>
																@switch($s->type)
																    @case('text')

																    	<input type="text" value="{{checkValue($p->services,$s->name)}}" data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control" placeholder="{{$s->placeholder}}">
																        
																        @break

																    @case('text-masked')

																    	<input type="text" value="{{checkValue($p->services,$s->name)}}" data-key="{{$s->name}}" data-title="{{$s->label}}" class="masked question form-control" placeholder="{{$s->placeholder}}">
																        
																        @break

																    @case('number')

																    	<input type="number" value="{{checkValue($p->services,$s->name)}}" data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control" placeholder="{{$s->placeholder}}">
																        
																        @break

																    @case('select')

																    	<select data-key="{{$s->name}}" data-title="{{$s->label}}" class="question form-control">
																    		@foreach ($s->options as $opt)
																    			<option {{checkValue($p->services,$s->name) == $opt->value ? 'selected' : ''}}>{{$opt->value}}</option>
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

												@php
													function checkValueProcess($process,$key,$other = false)
													{
														$process = json_decode($process,true);
														if (isset($process)) {
															foreach ($process as $s) {
																if ($s['key'] == $key) {
																	if ($other) {
																		return $s['value'];
																	}
																	if (array_key_exists('other', $s)) {
																		return 'Otro';
																	}
																	return $s['value'];
																}
															}
														}
													}
												@endphp
												
												@foreach ($sections as $s)
														<div class="col-sm-12">
															<h4>{{$s->name}}</h4>
														</div>

													@foreach ($s->inputs as $pr)
														<div class="col-sm-6">
																
																<div class="form-group">
																	<label>{{$pr->label}}</label>
																	@switch($pr->type)
																	    @case('text')

																	    	<input type="text" value="{{checkValueProcess($p->processes,$pr->name)}}" data-key="{{$pr->name}}" data-title="{{$pr->label}}" class="processes form-control" placeholder="{{$pr->placeholder}}">
																	        
																	        @break

																	    @case('text-masked')

																	    	<input type="text" value="{{checkValueProcess($p->processes,$pr->name)}}" data-key="{{$pr->name}}" data-title="{{$pr->label}}" class="masked processes form-control" placeholder="{{$pr->placeholder}}">
																	        
																	        @break

																	    @case('number')

																	    	<input type="number" value="{{checkValueProcess($p->processes,$pr->name)}}" data-key="{{$pr->name}}" data-title="{{$pr->label}}" class="processes form-control" placeholder="{{$pr->placeholder}}">
																	        
																	        @break

																	    @case('select')

																	    	{{-- {{$p->processes}} --}}
																	    	<select data-key="{{$pr->name}}" data-title="{{$pr->label}}" class="processes form-control">
																	    		<option selected="" disabled=""></option>
																	    		@foreach ($pr->options as $opt)
																	    			<option {{checkValueProcess($p->processes,$pr->name) == $opt->value ? 'selected' : ''}}>{{$opt->value}}</option>
																	    		@endforeach
																	    	</select>

																	    	@if (checkValueProcess($p->processes,$pr->name) == 'Otro')
																	    		<input type="text" value="{{checkValueProcess($p->processes,$pr->name,true)}}" data-key="{{$pr->name}}" data-title="{{$pr->label}}" class="processes form-control other" placeholder="Especifique">
																	    	@endif
																	        
																	        @break
																	
																	@endswitch
																	
																</div>

														</div>
													@endforeach

													<hr>
												@endforeach

												<input name="lat" type="hidden" value="{{$p->lat}}">
						                        <input name="lng" type="hidden" value="{{$p->lng}}">
			                        	</div>

			                        	<div class="row">
			                        		<div class="col-sm-12">
			                        			<button type="submit" class="btn btn-success">Guardar</button>
			                        		</div>
			                        	</div>

			                        	</form>
                            			
                            		</div>

                            		<div class="tab-pane fade" id="medicion">

                            			@php
                            				function checkValueMeasuring($m,$field)
                            				{
                            					if ($m) {
                            						$m = json_decode($m,true);
	                            					if (array_key_exists($field, $m) && $m[$field] != '') {
	                            						return $m[$field];
	                            					}
                            					}
                            				}
                            			@endphp

                            			<form action="#" method="POST" id="formulario_2" enctype="multipart/form-data">
			                            {{csrf_field()}}

                            			<div class="row">
                            				
	                            			<div class="col-sm-12">
												<hr>

												<h3>Medición de Servicios Interiores</h3>
												<br>
											</div>

											<div class="col-sm-12">

												<label>NIVEL DE VOLTAJE PRESENTE</label>
												<br>
												<br>
												
												<div class="row">
													<div class="col-sm-3">RESULTADO:</div>
													<div class="col-sm-9">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<input type="text" class="form-control" name="results_1" value="{{checkValueMeasuring($p->measuring,'results_1')}}">
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_1') == 'Conforme' ? 'checked' : ''}} type="radio" name="according_1" id="according_1" value="Conforme">
																	  <label class="form-check-label" for="according_1">
																	    Conforme
																	  </label>
																	</div>
																</div>
															</div>

															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_1') == 'No Conforme' ? 'checked' : ''}} type="radio" name="according_1" id="according_1_1" value="No Conforme">
																	  <label class="form-check-label" for="according_1_1">
																	    No Conforme
																	  </label>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="col-sm-3">EQUIPO UTILIZADO:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="equipment_1" value="{{checkValueMeasuring($p->measuring,'equipment_1')}}">
														</div>
													</div>

													<div class="col-sm-3">CONFORME A:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="conform_1" value="{{checkValueMeasuring($p->measuring,'conform_1')}}">
														</div>
													</div>
												</div>

												<hr>

											</div>

											<div class="col-sm-12">

												<label>CORRIENTE MAXIMA PRESENTE AL MOMENTO DEL LEVANTAMIENTO</label>
												<br>
												<br>
												
												<div class="row">
													<div class="col-sm-3">RESULTADO:</div>
													<div class="col-sm-9">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<input type="text" class="form-control" name="results_2" value="{{checkValueMeasuring($p->measuring,'results_2')}}">
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'accordi2g_1') == 'Conforme' ? 'checked' : ''}} type="radio" name="according_2" id="according_2" value="Conforme">
																	  <label class="form-check-label" for="according_2">
																	    Conforme
																	  </label>
																	</div>
																</div>
															</div>

															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_2') == 'No Conforme' ? 'checked' : ''}} type="radio" name="according_2" id="according_2_1" value="No Conforme">
																	  <label class="form-check-label" for="according_2_1">
																	    No Conforme
																	  </label>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="col-sm-3">EQUIPO UTILIZADO:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="equipment_2" value="{{checkValueMeasuring($p->measuring,'equipment_2')}}">
														</div>
													</div>

													<div class="col-sm-3">CONFORME A:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="conform_2" value="{{checkValueMeasuring($p->measuring,'conform_2')}}">
														</div>
													</div>
												</div>

												<hr>

											</div>

											<div class="col-sm-12">
												
												<label>Resistencia de los electrodos artificiales y de la red de tierras</label>
												<br>
												<br>
												<div class="row">
													<div class="col-sm-3">RESULTADO:</div>
													<div class="col-sm-9">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<input type="text" class="form-control" name="results_3" value="{{checkValueMeasuring($p->measuring,'results_3')}}">
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_3') == 'Conforme' ? 'checked' : ''}} type="radio" name="according_3" id="according_3" value="Conforme">
																	  <label class="form-check-label" for="according_3">
																	    Conforme
																	  </label>
																	</div>
																</div>
															</div>

															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_3') == 'No Conforme' ? 'checked' : ''}} type="radio" name="according_3" id="according_3_1" value="No Conforme">
																	  <label class="form-check-label" for="according_3_1">
																	    No Conforme
																	  </label>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="col-sm-3">EQUIPO UTILIZADO:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="equipment_3" value="{{checkValueMeasuring($p->measuring,'equipment_3')}}">
														</div>
													</div>

													<div class="col-sm-3">CONFORME A:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="conform_3" value="{{checkValueMeasuring($p->measuring,'conform_3')}}">
														</div>
													</div>
												</div>

												<hr>

											</div>

											<div class="col-sm-12">
												<label>Polaridad de las conexiones</label>
												<br>
												<br>
												
												<div class="row">
													<div class="col-sm-3">RESULTADO:</div>
													<div class="col-sm-9">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<input type="text" class="form-control" name="results_4" value="{{checkValueMeasuring($p->measuring,'results_4')}}">
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_4') == 'Conforme' ? 'checked' : ''}} type="radio" name="according_4" id="according_4" value="Conforme">
																	  <label class="form-check-label" for="according_4">
																	    Conforme
																	  </label>
																	</div>
																</div>
															</div>

															<div class="col-sm-3">
																<div class="form-group">
																	<div class="form-check">
																	  <input class="form-check-input" {{checkValueMeasuring($p->measuring,'according_4') == 'No Conforme' ? 'checked' : ''}} type="radio" name="according_4" id="according_4_1" value="No Conforme">
																	  <label class="form-check-label" for="according_4_1">
																	    No Conforme
																	  </label>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="col-sm-3">EQUIPO UTILIZADO:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="equipment_4" value="{{checkValueMeasuring($p->measuring,'equipment_4')}}">
														</div>
													</div>

													<div class="col-sm-3">CONFORME A:</div>
													<div class="col-sm-9">
														<div class="form-group">
															<input type="text" class="form-control" name="conform_4" value="{{checkValueMeasuring($p->measuring,'conform_4')}}">
														</div>
													</div>
												</div>


											</div>

											<hr>
                            			</div>

                            			<div class="row">
			                        		<div class="col-sm-12">
			                        			<hr>
			                        			<div class="form-group">
			                        				<label>Archvo adicional</label>

			                        				<input type="file" name="aditional_file" class="form-control" accept=".xml,.xlsx,.xls">
			                        			</div>

			                        			@if ($p->aditional_file)
			                        				<a href="{{url('uploads/points/aditional_file',$p->aditional_file)}}" download="{{$p->aditional_file}}">
			                        				Descargar archivo actual
			                        				</a>
			                        			@endif
			                        			<hr>
			                        		</div>
                            			</div>
                            			<div class="row">
			                        		<div class="col-sm-12">

			                        			<div id="signature">
				                        			@if ($p->sign)

				                        				<img src="{{url('uploads/points/signatures',$p->sign)}}" alt="" width="600">

				                        				<br>
				                        				<br>

					                        			<input class="btn btn-warning btn-xs" type="button" value="Volver a cargar la firma" id="init-canvas">

					                        			<br>
					                        			<br>

				                        			
				                        			@else

					                        			<canvas id="myCanvas" width="600" height="300"></canvas>

					                        			<br><br>
					                        			<input class="btn btn-warning btn-xs" type="button" value="Resetear Firma" id="resetSign">
					                        			<br>
					                        			<br>
				                        			@endif
			                        			</div>


			                        			<button type="submit" class="btn btn-success">Guardar</button>
			                        		</div>
			                        	</div>

                            			</form>
                            		</div>

                            	</div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

	{{-- /**/ --}}
</div>

<style>
	
element.style {
}
#myCanvas {
    border: 4px solid #444;
    border-radius: 15px;
    background-color: #fafafa;
}
</style>

@endsection

@section('scripts')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCysLSKrqHKdBaYLdEP6wqmBFNR-85sMHs&libraries=places'></script>
<script type="text/javascript" src='{{ asset('dropzone.js') }}'></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

	var canvas = null;
	var signaturePad = null;
	
	@if ($p->sign)

	$('#init-canvas').click(function (e) {
		e.preventDefault();

		$('#signature').html(`
			<canvas id="myCanvas" width="600" height="300"></canvas>

			<br><br>
			<input class="btn btn-warning btn-xs" type="button" value="Resetear Firma" id="resetSign">
			<br>
			<br>
			`);
		canvas = document.querySelector("canvas");

		signaturePad = new SignaturePad(canvas);

		$('#resetSign').click(function (e) {
			e.preventDefault();
			signaturePad.clear();
		});
	});

	@else

		canvas = document.querySelector("canvas");

		signaturePad = new SignaturePad(canvas);

		$('#resetSign').click(function (e) {
			e.preventDefault();
			signaturePad.clear();
		});
	@endif


	var according = [];

	function getAccording()
	{
		according = {
			results_1:$('[name="results_1"]').val(),
			according_1:$('[name="according_1"]:checked').val(),
			equipment_1:$('[name="equipment_1"]').val(),
			conform_1:$('[name="conform_1"]').val(),
			results_2:$('[name="results_2"]').val(),
			according_2:$('[name="according_2"]:checked').val(),
			equipment_2:$('[name="equipment_2"]').val(),
			conform_2:$('[name="conform_2"]').val(),
			results_3:$('[name="results_3"]').val(),
			according_3:$('[name="according_3"]:checked').val(),
			equipment_3:$('[name="equipment_3"]').val(),
			conform_3:$('[name="conform_3"]').val(),
			results_4:$('[name="results_4"]').val(),
			according_4:$('[name="according_4"]:checked').val(),
			equipment_4:$('[name="equipment_4"]').val(),
			conform_4:$('[name="conform_4"]').val(),
		}
	}

	$('#formulario_2').submit(async function (e) {
		e.preventDefault();

		getAccording();

		console.log(according);

		$('#formulario').submit();
	});

	const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
        const byteCharacters = atob(b64Data);
        const byteArrays = [];

        for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
          const slice = byteCharacters.slice(offset, offset + sliceSize);

          const byteNumbers = new Array(slice.length);
          for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
          }

          const byteArray = new Uint8Array(byteNumbers);
          byteArrays.push(byteArray);
        }

        const blob = new Blob(byteArrays, {type: contentType});
        return blob;
    }

	$('#formulario').submit(async function (e) {
		e.preventDefault();

		getAccording();

		let direccion = "Calle "+$(this)[0].street.value+', '+$(this)[0].colony.value+', '+$(this)[0].municipality.value+', '+$(this)[0].municipality.value+', '+$(this)[0].cp.value;

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

		var formData = new FormData($(this)[0]);

		console.log(formData);

		let services = [];
		let processes = [];

		let arr = Array.from($('.question'));
		let prc = Array.from($('.processes'));

		for (let i of arr) {
			if ($(i).val() != 'Otro') {
				var tmp = {};
				tmp.key = $(i).data('key');
				tmp.title = $(i).data('title');
				tmp.value = $(i).val();
			}
			if ($(i).hasClass('other')) {
				var tmp = {};
				tmp.key = $(i).data('key');
				tmp.title = $(i).data('title');
				tmp.value = $(i).val();
				tmp.other = true;
			}

			services.push(tmp);
		}

		for (let i of prc) {
			if ($(i).val() != 'Otro') {
				var tmp = {};
				tmp.key = $(i).data('key');
				tmp.title = $(i).data('title');
				tmp.value = $(i).val();
			}
			if ($(i).hasClass('other')) {
				var tmp = {};
				tmp.key = $(i).data('key');
				tmp.title = $(i).data('title');
				tmp.value = $(i).val();
				tmp.other = true;
			}

			processes.push(tmp);
		}
		
		formData.append('services',JSON.stringify(services));
		formData.append('processes',JSON.stringify(processes));
		formData.append('measuring',JSON.stringify(according));

		if ($('[name="aditional_file"]')[0].files.length) {
			formData.append('aditional_file',$('[name="aditional_file"]')[0].files[0]);
		}

		if (signaturePad) {
			let contentType = "image/png";
	        let base64 = signaturePad.toDataURL();
	        let b64Data = base64.split(",")[1];

	        const blob = b64toBlob(b64Data, contentType);
	        const blobUrl = URL.createObjectURL(blob);

	        formData.append("signature", blob);
		}

		// return console.log(services,processes);

		var b = $(this);
		/*if (myDropzone.files) {
            $.each(myDropzone.files, function(index, val) {
                if (val != undefined) {
                    allGallery.push(val.upload.uuid);
                }
            });

            $('#allGallery').val(allGallery);
        }*/

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

			/*setTimeout(()=>{
				window.open(data.url,'_self');
			},2000)*/

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

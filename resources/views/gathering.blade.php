@extends('layout')

@section('content')

<style>
	.other {
		margin-top: 8px;
	}
	.main-line {
		margin-bottom: 8px;
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
                <li class="breadcrumb-item active">Punto - Levantamiento</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="{{ url('admin/'.$p->id,'points') }}" style="margin-left: 8px;" class="btn btn-xs float-right hidden-sm-down btn-info">Ir a Editar</a>
            <a href="{{ url('admin/'.$p->id,'report') }}" style="margin-left: 8px;" class="btn btn-xs float-right hidden-sm-down btn-success">Ir a Reportear</a>

            <a href="{{url('IT-01 PLANEACION DE LA visita de levantamiento.pdf')}}" download class="btn btn-xs float-right hidden-sm-down btn-warning">Descargar Formato PDF Levantamiento</a>
        </div>
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">

        	<ul class="nav nav-tabs" id="myTab" role="tablist">
        	  <li class="nav-item" role="presentation">
			    <a class="nav-link active" data-toggle="tab" href="#images">Imágenes</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#check_lists">Check List</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#electric_system_description">Descr. del sistema eléctrico</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#survey_validation">Valid. del tipo de levantamiento</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#equipment_inventory">Inv. de equipo</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#visit_validation">Valid. de la visita de campo</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#single_diagram">Diagrama unifilar</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#equipment_inventory_2">Inv. de equipo</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#diagram_upload">Carga de diagrama</a>
			  </li>

			  {{-- <li class="nav-item" role="presentation">
			    <a class="nav-link" data-toggle="tab" href="#test_report">Informe de pruebas</a>
			  </li> --}}
			</ul>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Fases de Levantamiento</h4>
                    <div class="m-t-40">

                    	<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="images">
						  	<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label>Imágenes</label>
										<div class="row">
											@foreach(App\Models\PointImage::where('point_id',$p->id)->get() as $ga)
												<div class="col-lg-2 text-center">
													<div style="width: 100%; height: 200px; background-size: cover; background-position: center; background-image: url('{{ url('uploads/points/'.$p->id.'/images',$ga->image) }}'); border: 1px solid #f1f1f1; border-radius: 6px;">
														
													</div>
													<button class="btn btn-danger btn-xs" onclick="deleteGallery('{{ $ga->key }}' , $(this))" style="margin-top:10px">
														Eliminar
													</button>
												</div>
											@endforeach
										</div>
										<br>
										<form action="{{ url('/api/upload-files',$p->id) }}" class="dropzone" id="newDrop"></form>
									</div>
								</div>
							</div>
						  </div>
						  <div class="tab-pane fade" id="check_lists">

						  	<label>Check List</label>

						  	<div class="row">
						  		<div class="col-sm-3">
						  			<th>MEDIO DE RECEPCION</th>
						  		</div>
						  		<div class="col-sm-3">
						  			<th>TIPO DE INFORMACION</th>
						  		</div>
						  		<div class="col-sm-3">
						  			<th>OBSERVACIONES</th>
						  		</div>
						  		<div class="col-sm-3">
						  			<th>FECHA DE RECEPCION</th>
						  		</div>
						  	</div>

						  	@php
						  		function checkLists($p,$n,$i)
						  		{
						  			if ($p->survey) {
						  				$cl = json_decode($p->survey->check_lists,true)[0];
						  				return $cl[$n][$i];
						  			}
						  		}
						  	@endphp

						  	<form action="#" id="check_lists_form">
							  	@for ($i = 0; $i < 8; $i++)
							  		<div class="form-group">
									  	<div class="row">
									  		<div class="col-sm-3">
									  			<select name="medio" class="form-control" id="">
									  				<option value="" selected></option>
									  				<option {{checkLists($p,'medio',$i) == 'Electrónico' ? 'selected' : '' }} >Electrónico</option>
									  				<option {{checkLists($p,'medio',$i) == 'Físico' ? 'selected' : '' }} >Físico</option>
									  			</select>
									  		</div>
									  		<div class="col-sm-3">
									  			<input type="text" class="form-control" name="tipo" value="{{checkLists($p,'tipo',$i)}}">
									  		</div>
									  		<div class="col-sm-3">
									  			<select name="observaciones" class="form-control" id="">
									  				<option value="" selected></option>
									  				<option {{checkLists($p,'observaciones',$i) == 'Actualizado' ? 'selected' : '' }}>Actualizado</option>
									  				<option {{checkLists($p,'observaciones',$i) == 'Versión Antigüa' ? 'selected' : '' }}>Versión Antigüa</option>
									  			</select>
									  		</div>
									  		<div class="col-sm-3">
									  			<input type="date" class="form-control" name="fecha" value="{{checkLists($p,'fecha',$i)}}">
									  		</div>
									  	</div>
							  		</div>
							  	@endfor
						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>
						  <div class="tab-pane fade" id="electric_system_description">

						  	<label>Descripción del sistema eléctrico</label>

						  	<form action="#" id="electric_system_description_form">
						  		
						  		<textarea name="description_s" class="form-control" rows="8">{{ $p->survey ? json_decode($p->survey->electric_system_description,true) : '' }}</textarea>

						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>
						  <div class="tab-pane fade" id="survey_validation">

						  	<label>Validación del tipo de levantamiento</label>

						  	@php
						  		function surveyValidation($p,$n)
						  		{
						  			if ($p->survey) {
						  				$cl = json_decode($p->survey->survey_validation,true)[0];
						  				return $cl[$n];
						  			}
						  		}

						  		function surveyValidationCheck($p,$n,$i)
						  		{
						  			if ($p->survey) {
						  				$cl = json_decode($p->survey->survey_validation,true)[0];
						  				foreach ($cl[$n] as $key => $value) {
						  					if ($value == $i) {
						  						return true;
						  					}
						  				}
						  			}
						  		}
						  	@endphp

						  	<form action="#" id="survey_validation_form">

							  	<div class="row">
							  		<div class="col-sm-8">
							  			<label>Tipo de verificación</label>

							  			<div class="row">
							  				<div class="col-sm-3">
							  					<div class="form-check">
									  				<label class="form-check-label">
									  					<input type="checkbox" class="form-check-input" name="tipo" {{surveyValidationCheck($p,'tipo',1) ? 'checked' : ''}} value="1">
									  					Documental
									  				</label>
									  			</div>
							  				</div>
							  				<div class="col-sm-3">
							  					<div class="form-check">
									  				<label class="form-check-label">
									  					<input type="checkbox" class="form-check-input" name="tipo" {{surveyValidationCheck($p,'tipo',2) ? 'checked' : ''}} value="2">
									  					Ocular
									  				</label>
									  			</div>
							  				</div>
							  				<div class="col-sm-3">
							  					<div class="form-check">
									  				<label class="form-check-label">
									  					<input type="checkbox" class="form-check-input" name="tipo" {{surveyValidationCheck($p,'tipo',3) ? 'checked' : ''}} value="3">
									  					Comprobación
									  				</label>
									  			</div>
							  				</div>
							  				<div class="col-sm-3">
							  					<div class="form-check">
									  				<label class="form-check-label">
									  					<input type="checkbox" class="form-check-input" name="tipo" {{surveyValidationCheck($p,'tipo',4) ? 'checked' : ''}} value="4">
									  					Medición 
									  				</label>
									  			</div>
							  				</div>
							  			</div>
							  		</div>

							  		<div class="col-sm-4">
							  			<label>Criterio de aceptación o rechazo</label>

							  			<select name="cumplimiento" class="form-control">
							  				<option value="" selected></option>
							  				<option {{surveyValidation($p,'cumplimiento') == 'Cumple' ? 'selected' : '' }}>Cumple</option>
							  				<option {{surveyValidation($p,'cumplimiento') == 'No Cumple' ? 'selected' : '' }}>No Cumple</option>
							  			</select>
							  		</div>

							  		<div class="col-sm-12">
							  			<hr>
							  			<div class="row">
							  				<div class="col-sm-12">
							  					<label>Observaciones en el levantamiento</label>
							  				</div>

							  				<div class="col-sm-6">
							  					<label>Proyecto</label>
							  					<textarea name="observations_1" class="form-control" rows="4">{{surveyValidation($p,'observations_1')}}</textarea>
							  				</div>
							  				<div class="col-sm-6">
							  					<label>En sitio</label>
							  					<textarea name="observations_2" class="form-control" rows="4">{{surveyValidation($p,'observations_2')}}</textarea>
							  				</div>
							  			</div>
							  		</div>
							  	</div>
						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>
						  <div class="tab-pane fade" id="equipment_inventory">

						  	<label>Inventario de equipo</label>

						  	<form action="#" id="equipment_inventory_form">
						  		
					  			<div class="row">
					  				<div class="col-sm-11">
					  					<div class="row">
					  						
					  						<div class="col-sm-6">
								  				<div class="row">
								  					<div class="col-sm-3"><b>Consec.</b></div>
								  					<div class="col-sm-3"><b>Descripción</b></div>
								  					<div class="col-sm-3"><b>Modelo</b></div>
								  					<div class="col-sm-3"><b>Marca</b></div>
								  				</div>
								  			</div>
								  			<div class="col-sm-6">
								  				<div class="row">
								  					<div class="col-sm-3"><b>Tensión/Voltaje</b></div>
								  					<div class="col-sm-3"><b>Corriente Amps</b></div>
								  					<div class="col-sm-3"><b>Z Impedancia o reactancia</b></div>
								  					<div class="col-sm-3"><b>Cap interruptiva</b></div>
								  				</div>
								  			</div>
					  					</div>	
					  				</div>
					  				<div class="col-sm-1">
					  					<button class="btn btn-success" id="add-inv_1"><i class="fas fa-plus"></i></button>
					  				</div>
					  			</div>

						  		<hr>

						  		@php
							  		function equipment($p,$n,$i)
							  		{
							  			if ($p->survey) {
							  				$cl = json_decode($p->survey->equipment_inventory,true)[0];
							  				return $cl[$n][$i];
							  			}
							  		}
							  	@endphp

						  		<div id="inv_1">

						  			@if ($p->survey && $p->survey->equipment_inventory)

						  				@foreach (json_decode($p->survey->equipment_inventory,true)[0]['consec'] as $key => $value)
						  					
						  					<div class="row main-line nuevo">
								  				<div class="col-sm-11">
								  					<div class="row">
											  			<div class="col-sm-6">
											  				<div class="row">
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'consec',$key)}}" name="consec">
											  					</div>
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'descr',$key)}}" name="descr">
											  					</div>
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'modelo',$key)}}" name="modelo">
											  					</div>
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'marca',$key)}}" name="marca">
											  					</div>
											  				</div>
											  			</div>
											  			<div class="col-sm-6">
											  				<div class="row">
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'tension',$key)}}" name="tension">
											  					</div>
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'corrie',$key)}}" name="corrie">
											  					</div>
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'impeda',$key)}}" name="impeda">
											  					</div>
											  					<div class="col-sm-3">
											  						<input type="text" class="form-control" value="{{equipment($p,'interr',$key)}}" name="interr">
											  					</div>
											  				</div>
											  			</div>
											  		</div>	
								  				</div>
								  				<div class="col-sm-1">
								  					<button onclick="removeParent(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
								  				</div>
								  			</div>

						  				@endforeach
						  			
						  			@else

						  				<div class="row main-line">
							  				<div class="col-sm-11">
							  					<div class="row">
										  			<div class="col-sm-6">
										  				<div class="row">
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="consec">
										  					</div>
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="descr">
										  					</div>
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="modelo">
										  					</div>
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="marca">
										  					</div>
										  				</div>
										  			</div>
										  			<div class="col-sm-6">
										  				<div class="row">
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="tension">
										  					</div>
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="corrie">
										  					</div>
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="impeda">
										  					</div>
										  					<div class="col-sm-3">
										  						<input type="text" class="form-control" name="interr">
										  					</div>
										  				</div>
										  			</div>
										  		</div>	
							  				</div>
							  				<div class="col-sm-1">
							  					<button onclick="removeParent(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
							  				</div>
							  			</div>

						  			@endif

						  		</div>


						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>
						  <div class="tab-pane fade" id="visit_validation">

						  	<label>Validación de la visita de campo</label>

						  	@php
						  		function visitVal($p,$n)
						  		{
						  			if ($p->survey) {
						  				$cl = json_decode($p->survey->visit_validation,true)[0];
						  				return $cl[$n][0];
						  			}
						  		}
						  	@endphp

						  	<form action="#" id="visit_validation_form">
						  		
						  		<div class="row">
						  			<div class="col-sm-12">
						  				<div class="form-group">
						  					
							  				<label>NOMBRE, DENOMINACION O RAZON SOCIAL DEL ESTABLECIMIENTO</label>

							  				<textarea name="name" class="form-control" rows="1">{{visitVal($p,'name')}}</textarea>

						  				</div>
						  			</div>

						  			<div class="col-sm-12">
						  				<div class="form-group">
							  				<label>Giro</label>

							  				<input type="text" value="{{visitVal($p,'giro')}}" name="giro" class="form-control">
						  				</div>

						  				<hr>
						  			</div>

						  			<div class="col-sm-12">
						  				<label>
						  					DOMICILIO DE LA INSTALACION
						  				</label>

						  				<div class="row">
						  					<div class="col-sm-6">
						  						<div class="form-group">
						  							<label>Calle o Avenida</label>
						  							<input type="text" value="{{visitVal($p,'calle')}}" name="calle" class="form-control">
						  						</div>
						  					</div>
						  					<div class="col-sm-6">
						  						<div class="form-group">
						  							<label>No (Interior o exterior)</label>
						  							<input type="number" value="{{visitVal($p,'no')}}" name="no" class="form-control">
						  						</div>
						  					</div>
						  					<div class="col-sm-12">
						  						<div class="form-group">
						  							<label>Colonia o población</label>
						  							<input type="text" value="{{visitVal($p,'colonia')}}" name="colonia" class="form-control">
						  						</div>
						  					</div>

						  					<div class="col-sm-6">
						  						<div class="form-group">
						  							<label>Municipio o delegación</label>
						  							<input type="text" value="{{visitVal($p,'municipio')}}" name="municipio" class="form-control">
						  						</div>
						  					</div>
						  					<div class="col-sm-6">
						  						<div class="form-group">
						  							<label>C.P.</label>
						  							<input type="number" value="{{visitVal($p,'cp')}}" name="cp" class="form-control">
						  						</div>
						  					</div>

						  					<div class="col-sm-12">
						  						<div class="form-group">
						  							<label>Ciudad o Estado</label>
						  							<input type="text" value="{{visitVal($p,'ciudad')}}" name="ciudad" class="form-control">
						  						</div>
						  					</div>

						  					<div class="col-sm-6">
						  						<div class="form-group">
						  							<label>Teléfono(s)</label>
						  							<input type="number" value="{{visitVal($p,'telefono')}}" name="telefono" class="form-control">
						  						</div>
						  					</div>
						  					<div class="col-sm-6">
						  						<div class="form-group">
						  							<label>Fax</label>
						  							<input type="number" value="{{visitVal($p,'fax')}}" name="fax" class="form-control">
						  						</div>
						  					</div>

						  					<div class="col-sm-12">
						  						<hr>
						  						<div class="form-group">
						  							<label>NOMBRE Y CARGO DE LA PERSONA QUE ATENDIO LA VISITA:</label>
						  							<input type="text" value="{{visitVal($p,'name_2')}}" name="name_2" class="form-control">
						  						</div>

						  						<hr>
						  					</div>
						  				</div>
						  			</div>
						  		</div>

						  		<label>
						  			FIRMAS DE LOS QUE INTERVINIERON EN LA DILIGENCIA
						  		</label>

						  		<div class="row">
						  			<div class="col-sm-6">
						  				<div class="form-group">
						  					<label>Técnico de campo</label>

						  					<input type="text" value="{{visitVal($p,'tech')}}" name="tech" class="form-control">
						  				</div>
						  			</div>
						  			<div class="col-sm-6">
						  				<div class="form-group text-center">
						  					<label>Firma</label>

						  					<div id="signaturet">
			                        			@if ($p->survey && $p->survey->sign)

			                        				<img src="{{url('uploads/points/signatures',$p->survey->sign)}}" alt="" width="400">

			                        				<br>
			                        				<br>

				                        			<input class="btn btn-warning btn-xs" type="button" value="Volver a cargar la firma" id="init-canvast">

				                        			<br>
				                        			<br>

			                        			
			                        			@else

				                        			<canvas id="myCanvast" width="400" height="300"></canvas>

				                        			<br><br>
				                        			<input class="btn btn-warning btn-xs" type="button" value="Resetear Firma" id="resetSignt">
				                        			<br>
				                        			<br>
			                        			@endif
		                        			</div>
						  				</div>
						  			</div>
						  		</div>

						  		<div class="row">
						  			<div class="col-sm-12">
						  				<hr>
						  			</div>
						  			<div class="col-sm-6">
						  				<label>Datos del cliente</label>
						  				<div class="form-group">
						  					<input type="text" placeholder="Nombre" value="{{visitVal($p,'c_name')}}" name="c_name" class="form-control">
						  				</div>

						  				<div class="form-group">
						  					<input type="text" placeholder="Identificación" value="{{visitVal($p,'c_id')}}" name="c_id" class="form-control">
						  				</div>

						  				<div class="form-group">
						  					<input type="text" placeholder="Número o folio de la Identificación" value="{{visitVal($p,'c_nid')}}" name="c_nid" class="form-control">
						  				</div>

						  				<div class="form-group">
						  					<input type="text" placeholder="Expedida por" value="{{visitVal($p,'c_exp')}}" name="c_exp" class="form-control">
						  				</div>

						  				<div class="form-group">
						  					<input type="text" placeholder="Dirección" value="{{visitVal($p,'c_add')}}" name="c_add" class="form-control">
						  				</div>
						  			</div>
						  			<div class="col-sm-6">
						  				<div class="form-group text-center">
						  					<label>Firma</label>

						  					<div id="signature">
			                        			@if ($p->sign)

			                        				<img src="{{url('uploads/points/signatures',$p->sign)}}" alt="" width="400">

			                        				<br>
			                        				<br>

				                        			<input class="btn btn-warning btn-xs" type="button" value="Volver a cargar la firma" id="init-canvas">

				                        			<br>
				                        			<br>

			                        			
			                        			@else

				                        			<canvas id="myCanvas" width="400" height="300"></canvas>

				                        			<br><br>
				                        			<input class="btn btn-warning btn-xs" type="button" value="Resetear Firma" id="resetSign">
				                        			<br>
				                        			<br>
			                        			@endif
		                        			</div>
						  				</div>
						  			</div>
						  		</div>

						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>
						  <div class="tab-pane fade" id="single_diagram">

						  	<label>Diagrama unifilar</label>

						  	@php
						  		function singleDiagram($p,$n,$i)
						  		{
						  			if ($p->survey) {
						  				$cl = json_decode($p->survey->single_diagram,true)[0];
						  				if (count($cl[$n])) {
						  					return $cl[$n][$i];
						  				}
						  			}
						  		}

						  		$diagrams = [
									"MEDIDOR",
									"PROTECCION MEDIA TENSION",
									"TRANSFORMADOR",
									"PROTECCION PRINCIPAL BAJA TENSION",
									"TABLERO PRINCIPAL",
									"TABLEROS DERIVADOS",
									"CALIBRE ALIMENTADORES",
									"CANALIZACIONES",
									"LONGITUD ALIMENTADORES",
									"PROTECCIONES DERIVADAS",
									"CALIBRE  ALIMENTADORES DERIVADOS",
						  		];
						  	@endphp

						  	<form action="#" id="single_diagram_form">

						  		<label>LISTA DE OBSERVACIONES</label> <br>

						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" {{singleDiagram($p,'diagobserv',0) == 'MEMORIA' ? 'checked' : ''}} name="diagobserv" id="inlineRadio1" value="MEMORIA">
								  <label class="form-check-label" for="inlineRadio1">MEMORIA</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" {{singleDiagram($p,'diagobserv',0) == 'PROYECTO' ? 'checked' : ''}} name="diagobserv" id="inlineRadio2" value="PROYECTO">
								  <label class="form-check-label" for="inlineRadio2">PROYECTO</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" {{singleDiagram($p,'diagobserv',0) == 'OBRA' ? 'checked' : ''}} name="diagobserv" id="inlineRadio3" value="OBRA">
								  <label class="form-check-label" for="inlineRadio3">OBRA</label>
								</div>

								<hr>
						  		
						  		<div class="row">
						  			<div class="col-sm-4">
						  				<th>SECCIÓN</th>
						  			</div>
						  			<div class="col-sm-2">
						  				<th>EXISTENTE</th>
						  			</div>
						  			<div class="col-sm-6">
						  				<th>COMENTARIOS Y OBSERVACIONES</th>
						  			</div>
						  			<div class="col-sm-12">
						  				<hr>
						  			</div>
						  		</div>

						  		@foreach ($diagrams as $key => $value)
						  		<div class="form-group">
							  		<div class="row">
							  			<div class="col-sm-4">
							  				<label>{{$value}}</label>
							  			</div>
							  			<div class="col-sm-2">
							  				<select name="existente" class="form-control">
							  					<option value="" selected></option>
							  					<option {{singleDiagram($p,'existente',$key) == 'SI' ? 'selected' : '' }}>SI</option>
							  					<option {{singleDiagram($p,'existente',$key) == 'NO' ? 'selected' : '' }}>NO</option>
							  				</select>
							  			</div>
							  			<div class="col-sm-6">
							  				<textarea name="comentarios" class="form-control" rows="1">{{singleDiagram($p,'comentarios',$key)}}</textarea>
							  			</div>
							  		</div>
						  		</div>
						  		@endforeach


						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>

						  <div class="tab-pane fade" id="diagram_upload">

						  	<label>Carga de Diagrama</label>

						  	<div class="form-group">
						  		<input type="file" name="diagram_file" class="form-control">
						  	</div>

						  	@if ($p->survey && $p->survey->diagram)
						  		
						  		<a href="{{url('uploads/points/diagrams',$p->survey->diagram)}}" download="{{$p->survey->diagram}}">
                				Descargar Diagrama actual
                				</a>

						  	@endif

						  	<hr>

						  	<button class="submit btn btn-success">Guardar</button>

						  </div>
						  <div class="tab-pane fade" id="equipment_inventory_2">

						  	<label>Inventario de equipo</label>

						  	<form action="#" id="equipment_inventory_2_form">
						  		
					  			<div class="row">
					  				<div class="col-sm-11">
					  					<div class="row">
					  						
					  						<div class="col-sm-12">
								  				<div class="row">
								  					<div class="col-sm-2"><b>Equipo.</b></div>
								  					<div class="col-sm-2"><b>Marca</b></div>
								  					<div class="col-sm-2"><b>Descripción</b></div>
								  					<div class="col-sm-2"><b>NA</b></div>
								  					<div class="col-sm-2"><b>Cumplimiento</b></div>
								  					<div class="col-sm-2"><b>Observaciones</b></div>
								  				</div>
								  			</div>
					  					</div>	
					  				</div>
					  				<div class="col-sm-1">
					  					<button class="btn btn-success" id="add-inv_2"><i class="fas fa-plus"></i></button>
					  				</div>
					  			</div>

						  		<hr>

						  		@php
							  		function equipment2($p,$n,$i)
							  		{
							  			if ($p->survey) {
							  				$cl = json_decode($p->survey->equipment_inventory_2,true)[0];
							  				return $cl[$n][$i];
							  			}
							  		}
							  	@endphp

						  		<div id="inv_2">

						  			@if ($p->survey && $p->survey->equipment_inventory_2)

						  				@foreach (json_decode($p->survey->equipment_inventory_2,true)[0]['f2_equi'] as $key => $value)

						  					<div class="row main-line">
								  				<div class="col-sm-11">
								  					<div class="row">
											  			<div class="col-sm-12">
											  				<div class="row">
											  					<div class="col-sm-2">
											  						<input type="text" class="form-control" value="{{equipment2($p,'f2_equi',$key)}}" name="f2_equi">
											  					</div>
											  					<div class="col-sm-2">
											  						<input type="text" class="form-control" value="{{equipment2($p,'f2_marca',$key)}}" name="f2_marca">
											  					</div>
											  					<div class="col-sm-2">
											  						<input type="text" class="form-control" value="{{equipment2($p,'f2_descr',$key)}}" name="f2_descr">
											  					</div>
											  					<div class="col-sm-2">
											  						<input type="text" class="form-control" value="{{equipment2($p,'f2_na',$key)}}" name="f2_na">
											  					</div>
											  					<div class="col-sm-2">
											  						<select name="f2_cumpl" class="form-control">
											  							<option value="" selected></option>
											  							<option {{equipment2($p,'f2_cumpl',$key) == 'Cumple' ? 'selected' : ''}} >Cumple</option>
											  							<option {{equipment2($p,'f2_cumpl',$key) == 'No Cumple' ? 'selected' : ''}} >No Cumple</option>
											  						</select>
											  					</div>
											  					<div class="col-sm-2">
											  						<textarea name="f2_obser" class="form-control" rows="1">{{equipment2($p,'f2_obser',$key)}}</textarea>
											  					</div>
											  				</div>
											  			</div>
											  		</div>	
								  				</div>
								  				<div class="col-sm-1">
								  					<button onclick="removeParent(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
								  				</div>
								  			</div>

						  				@endforeach
						  			@else

							  			<div class="row main-line">
							  				<div class="col-sm-11">
							  					<div class="row">
										  			<div class="col-sm-12">
										  				<div class="row">
										  					<div class="col-sm-2">
										  						<input type="text" class="form-control" name="f2_equi">
										  					</div>
										  					<div class="col-sm-2">
										  						<input type="text" class="form-control" name="f2_marca">
										  					</div>
										  					<div class="col-sm-2">
										  						<input type="text" class="form-control" name="f2_descr">
										  					</div>
										  					<div class="col-sm-2">
										  						<input type="text" class="form-control" name="f2_na">
										  					</div>
										  					<div class="col-sm-2">
										  						<select name="f2_cumpl" class="form-control">
										  							<option value="" selected></option>
										  							<option>Cumple</option>
										  							<option>No Cumple</option>
										  						</select>
										  					</div>
										  					<div class="col-sm-2">
										  						<textarea name="f2_obser" class="form-control" rows="1"></textarea>
										  					</div>
										  				</div>
										  			</div>
										  		</div>	
							  				</div>
							  				<div class="col-sm-1">
							  					<button onclick="removeParent(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
							  				</div>
							  			</div>
						  			@endif


						  		</div>


						  	</form>

						  	<button class="submit btn btn-success">Guardar</button>

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
#myCanvas,#myCanvast {
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

	Dropzone.autoDiscover = false;
    var cT  = 'Cancelar';
    var cCt = 'Seguro de cancelar la subida?';
    var rT  = 'Remover';
    var lT  = 'El limite de imagenes es 20';
    var dT  = 'Click aqui para tomar una foto o seleccionar las imagenes';
    var eS  = 'Error al subir el archivo';
    var mT  = 'El peso mÃ¡ximo en archivos es de 80mb';

    var allGallery =[];

    var myDropzone = new Dropzone("#newDrop" , {
        addRemoveLinks:true,
        maxFiles:20,
        maxFilesize:80,
        dictCancelUpload:cT,
        dictCancelUploadConfirmation:cCt,
        dictRemoveFile:rT,
        dictMaxFilesExceeded:lT,
        dictDefaultMessage:dT,
        dictResponseError:eS,
        dictMaxFilesExceeded:mT,
    });

    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("token_image", file.upload.uuid);
        // alert('Hola');
    });

    myDropzone.on("removedfile", function(file) {
        // console.log(file.upload.uuid);
        $.ajax({
            url: '{{ url('/api/deleteFileGallery') }}',
            type: 'POST',
            data: {
                file:file.upload.uuid
            },
        })
        .done(function(data) {
            // console.log(data);
        })
        .fail(function(r) {
            console.log(r);
        })
        .always(function() {
            // console.log("complete");
        });
    });

	function deleteGallery(key , b){
		$.ajax({
            url: '{{ url('/api/deleteFileGallery') }}',
            type: 'POST',
            data: {
                file:key
            },
        })
        .done(function(data) {
            // console.log(data);
            var d = b.parent();
			d.remove();
        })
        .fail(function(r) {
            console.log(r);
        })
        .always(function() {
            // console.log("complete");
        });
	}

	/*$('#submit-main').click(function (e) {
		e.preventDefault();

		$('#formulario').submit();
	});*/

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

	$('.submit').click(function (e) {
		e.preventDefault();

		var checklist = [];
		var electricdescription = "";
		var validation = [];
		var equipment = [];
		var visit = [];
		var diagram = [];
		var equipment_2 = [];

		//*checklist*//

		let form = $('#check_lists_form').serializeArray();

		let medio = [];
		let observaciones = [];
		let tipo = [];
		let fecha = [];

		for (var i of form) {

			if (i.name == 'medio') {medio.push(i.value);}
			if (i.name == 'observaciones') {observaciones.push(i.value);}
			if (i.name == 'tipo') {tipo.push(i.value);}
			if (i.name == 'fecha') {fecha.push(i.value);}
		}

		checklist.push({
			medio : medio,
			observaciones : observaciones,
			tipo : tipo,
			fecha : fecha,
		});

		console.log(checklist);

		//*electric system*//

		electricdescription = $('[name="description_s"]').val();

		console.log(electricdescription);

		//*validacion*//

		let form_1 = $('#survey_validation_form').serializeArray();

		let tipo_2 = [];
		let cumplimiento = "";
		let observations_1 = "";
		let observations_2 = "";

		for(let i of form_1)
		{
			if (i.name == 'tipo') {
				tipo_2.push(i.value);
			}
			if (i.name == 'cumplimiento') {cumplimiento = i.value;}
			if (i.name == 'observations_1') {observations_1 = i.value;}
			if (i.name == 'observations_2') {observations_2 = i.value;}
		}

		validation.push({
			tipo:tipo_2,
			cumplimiento:cumplimiento,
			observations_1:observations_1,
			observations_2:observations_2
		})

		console.log(validation);

		let form_2 = $('#equipment_inventory_form').serializeArray();

		let consec = [];
		let descr = [];
		let modelo = [];
		let marca = [];
		let tension = [];
		let corrie = [];
		let impeda = [];
		let interr = [];

		for (var i of form_2) {

			if (i.name == 'consec') {consec.push(i.value);}
			if (i.name == 'descr') {descr.push(i.value);}
			if (i.name == 'modelo') {modelo.push(i.value);}
			if (i.name == 'marca') {marca.push(i.value);}
			if (i.name == 'tension') {tension.push(i.value);}
			if (i.name == 'corrie') {corrie.push(i.value);}
			if (i.name == 'impeda') {impeda.push(i.value);}
			if (i.name == 'interr') {interr.push(i.value);}
		}

		equipment.push({
			consec : consec,
			descr : descr,
			modelo : modelo,
			marca : marca,
			tension : tension,
			corrie : corrie,
			impeda : impeda,
			interr : interr,
		});
		
		console.log(equipment);

		let form_3 = $('#visit_validation_form').serializeArray();

		let name = [];
		let giro = [];
		let calle = [];
		let no = [];
		let colonia = [];
		let municipio = [];
		let cp = [];
		let ciudad = [];
		let telefono = [];
		let fax = [];
		let name_2 = [];

		let tech = [];
		let c_name = [];
		let c_id = [];
		let c_nid = [];
		let c_exp = [];
		let c_add = [];

		for(var i of form_3) {
			if (i.name == "name") {name.push(i.value);}
			if (i.name == "giro") {giro.push(i.value);}
			if (i.name == "calle") {calle.push(i.value);}
			if (i.name == "no") {no.push(i.value);}
			if (i.name == "colonia") {colonia.push(i.value);}
			if (i.name == "municipio") {municipio.push(i.value);}
			if (i.name == "cp") {cp.push(i.value);}
			if (i.name == "ciudad") {ciudad.push(i.value);}
			if (i.name == "telefono") {telefono.push(i.value);}
			if (i.name == "fax") {fax.push(i.value);}
			if (i.name == "name_2") {name_2.push(i.value);}

			if (i.name == 'tech') {tech.push(i.value);}
			if (i.name == 'c_name') {c_name.push(i.value);}
			if (i.name == 'c_id') {c_id.push(i.value);}
			if (i.name == 'c_nid') {c_nid.push(i.value);}
			if (i.name == 'c_exp') {c_exp.push(i.value);}
			if (i.name == 'c_add') {c_add.push(i.value);}
		}

		visit.push({
			name:name,
			giro:giro,
			calle:calle,
			no:no,
			colonia:colonia,
			municipio:municipio,
			cp:cp,
			ciudad:ciudad,
			telefono:telefono,
			fax:fax,
			name_2:name_2,

			tech:tech,
			c_name:c_name,
			c_id:c_id,
			c_nid:c_nid,
			c_exp:c_exp,
			c_add:c_add,
		})

		console.log(visit);

		let form_4 = $('#single_diagram_form').serializeArray();

		let diagobserv = [];
		let existente = [];
		let comentarios = [];

		for(var i of form_4) {
			if (i.name == "diagobserv") {diagobserv.push(i.value);}
			if (i.name == "existente") {existente.push(i.value);}
			if (i.name == "comentarios") {comentarios.push(i.value);}
		}

		diagram.push({
			diagobserv:diagobserv,
			existente:existente,
			comentarios:comentarios,
		});

		console.log(diagram);

		let form_5 = $('#equipment_inventory_2_form').serializeArray();

		let f2_equi = [];
		let f2_marca = [];
		let f2_descr = [];
		let f2_na = [];
		let f2_cumpl = [];
		let f2_obser = [];

		for(var i of form_5) {
			if (i.name == "f2_equi") {f2_equi.push(i.value);}
			if (i.name == "f2_marca") {f2_marca.push(i.value);}
			if (i.name == "f2_descr") {f2_descr.push(i.value);}
			if (i.name == "f2_na") {f2_na.push(i.value);}
			if (i.name == "f2_cumpl") {f2_cumpl.push(i.value);}
			if (i.name == "f2_obser") {f2_obser.push(i.value);}
		}

		equipment_2.push({
			f2_equi:f2_equi,
			f2_marca:f2_marca,
			f2_descr:f2_descr,
			f2_na:f2_na,
			f2_cumpl:f2_cumpl,
			f2_obser:f2_obser,
		});

		console.log(equipment_2);

		var formData = new FormData();

		if (signaturePad) {
			let contentType = "image/png";
	        let base64 = signaturePad.toDataURL();
	        let b64Data = base64.split(",")[1];

	        const blob = b64toBlob(b64Data, contentType);
	        const blobUrl = URL.createObjectURL(blob);

	        formData.append("signature", blob);
		}

		if (signaturePadt) {
			let contentType = "image/png";
	        let base64 = signaturePadt.toDataURL();
	        let b64Data = base64.split(",")[1];

	        const blob = b64toBlob(b64Data, contentType);
	        const blobUrl = URL.createObjectURL(blob);

	        formData.append("signaturet", blob);
		}
	    
	    formData.append("checklist", JSON.stringify(checklist));
	    formData.append("electricdescription", JSON.stringify(electricdescription));
	    formData.append("validation", JSON.stringify(validation));
	    formData.append("equipment", JSON.stringify(equipment));
	    formData.append("visit", JSON.stringify(visit));
	    formData.append("diagram", JSON.stringify(diagram));
	    formData.append("equipment_2", JSON.stringify(equipment_2));

	    if ($('[name="diagram_file"]')[0].files.length) {
			formData.append('diagram_file',$('[name="diagram_file"]')[0].files[0]);
		}

	    formData.append("_token", '{{csrf_token()}}');


		$.ajax({
			url: '{{url('saveSurvey',$p->id)}}',
			type: 'POST',
			processData: false,
			contentType: false,
			data: formData,
		})
		.done(function() {
			console.log("success");

			Swal.fire({
			  title:'Datos guardados!',
			  icon:'success'
			});
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	$('#add-inv_2').click(function (e) {
		e.preventDefault();

		$('#inv_2').append(`
			<div class="row main-line">
  				<div class="col-sm-11">
  					<div class="row">
			  			<div class="col-sm-12">
			  				<div class="row">
			  					<div class="col-sm-2">
			  						<input type="text" class="form-control" name="f2_equi">
			  					</div>
			  					<div class="col-sm-2">
			  						<input type="text" class="form-control" name="f2_marca">
			  					</div>
			  					<div class="col-sm-2">
			  						<input type="text" class="form-control" name="f2_descr">
			  					</div>
			  					<div class="col-sm-2">
			  						<input type="text" class="form-control" name="f2_na">
			  					</div>
			  					<div class="col-sm-2">
			  						<select name="f2_cumpl" class="form-control">
			  							<option value="" selected></option>
			  							<option>Cumple</option>
			  							<option>No Cumple</option>
			  						</select>
			  					</div>
			  					<div class="col-sm-2">
			  						<textarea name="f2_obser" class="form-control" rows="1"></textarea>
			  					</div>
			  				</div>
			  			</div>
			  		</div>	
  				</div>
  				<div class="col-sm-1">
  					<button onclick="removeParent(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
  				</div>
  			</div>
		`)
	});

	$('#add-inv_1').click(function (e) {
		e.preventDefault();

		$('#inv_1').append(`
			<div class="row main-line">
  				<div class="col-sm-11">
  					<div class="row">
			  			<div class="col-sm-6">
			  				<div class="row">
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="consec">
			  					</div>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="descr">
			  					</div>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="modelo">
			  					</div>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="marca">
			  					</div>
			  				</div>
			  			</div>
			  			<div class="col-sm-6">
			  				<div class="row">
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="tension">
			  					</div>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="corrie">
			  					</div>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="impeda">
			  					</div>
			  					<div class="col-sm-3">
			  						<input type="text" class="form-control" name="interr">
			  					</div>
			  				</div>
			  			</div>
			  		</div>	
  				</div>
  				<div class="col-sm-1">
  					<button onclick="removeParent(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
  				</div>
  			</div>
		`)
	});

	function removeParent(e)
	{
		$(e).parents('.main-line').remove();
	}




	/**/


	var canvas = null;
	var signaturePad = null;
	
	@if ($p->sign)

	$('#init-canvas').click(function (e) {
		e.preventDefault();

		$('#signature').html(`
			<canvas id="myCanvas" width="400" height="300"></canvas>

			<br><br>
			<input class="btn btn-warning btn-xs" type="button" value="Resetear Firma" id="resetSign">
			<br>
			<br>
			`);
		canvas = document.querySelector("#myCanvas");

		signaturePad = new SignaturePad(canvas);

		$('#resetSign').click(function (e) {
			e.preventDefault();
			signaturePad.clear();
		});
	});

	@else

		canvas = document.querySelector("#myCanvas");

		signaturePad = new SignaturePad(canvas);

		$('#resetSign').click(function (e) {
			e.preventDefault();
			signaturePad.clear();
		});
	@endif


	var canvast = null;
	var signaturePadt = null;
	
	@if ($p->survey && $p->survey->sign)

	$('#init-canvast').click(function (e) {
		e.preventDefault();

		$('#signaturet').html(`
			<canvas id="myCanvast" width="400" height="300"></canvas>

			<br><br>
			<input class="btn btn-warning btn-xs" type="button" value="Resetear Firma" id="resetSign">
			<br>
			<br>
			`);
		canvast = document.querySelector("#myCanvast");

		signaturePadt = new SignaturePad(canvast);

		$('#resetSignt').click(function (e) {
			e.preventDefault();
			signaturePad.clear();
		});
	});

	@else

		canvast = document.querySelector("#myCanvast");

		signaturePadt = new SignaturePad(canvast);

		$('#resetSignt').click(function (e) {
			e.preventDefault();
			signaturePadt.clear();
		});
	@endif

</script>
@endsection

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

<table id="myTable">
	<thead>
		<tr>
			<th>Calle</th>
			<th>Código Postal</th>
			<th>Entidad</th>
			<th>Municipio</th>
			<th>Responsable</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@foreach (App\Models\Point::where('customer_id',$customer->id)->get() as $p)
		<tr>
			<td>{{$p->street}}</td>
			<td>{{$p->cp}}</td>
			<td>{{$p->entity}}</td>
			<td>{{$p->municipality}}</td>
			<td>{{$p->responsable}}</td>
			<td>
				<a href="#edit-{{$p->id}}" data-toggle="modal" class="btn btn-sm btn-info">Editar</a>

				<div class="modal fade" id="edit-{{$p->id}}">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 style="margin: 0;">Editar punto</h5>
						</div>
						<div class="modal-body">
							<form action="{{ url('updatepoint-front') }}" method="POST" class="formulario-edit">
								{{csrf_field()}}

								<input type="hidden" name="id" value="{{$p->id}}">

								<div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Datos del Punto </h4>
                                    </div>

                                    <div class="col-sm-10 col-sm-offset-1">
                                    	<div class="picture-container">
                                        	<div class="picture" style="border-radius: 8px;">
                                        		@if ($p->image)
                                					<img src="{{url('/uploads/points',$p->image)}}" class="picture-src" id="wizardPicturePreview1" title=""/>
                                        		@else
                                					<img src="{{url('/frontend')}}/assets/img/default-image.png" class="picture-src" id="wizardPicturePreview1" title=""/>
                                        		@endif
                                            	<input type="file" name="point_image" id="wizard-picture-2">
                                        	</div>
                                        	<h6>Imagen de referencia</h6>
                                    	</div>
                                	</div>

                                    {{-- <div class="col-sm-10 col-sm-offset-1">
                                    	<div class="form-group -label-floating">
                                    		<label class="control-label">Dirección</label>
                                			<input autocomplete="off" id="autocomplete" type="text" class="form-control">
                                    	</div>
                                    </div> --}}
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Calle</label>
                                            <input name="street" value="{{$p->street}}" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Código Postal</label>
                                            <input name="cp" value="{{$p->cp}}" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Entidad</label>
                                            <input name="entity" value="{{$p->entity}}" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Municipio</label>
                                            <input name="municipality" value="{{$p->municipality}}" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Colonia</label>
                                            <input name="colony" value="{{$p->colony}}" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nº Exterior</label>
                                            <input name="n_exterior" value="{{$p->n_exterior}}" type="number" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nº Interior</label>
                                            <input name="n_interior" value="{{$p->n_interior}}" type="number" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Responsable</label>
                                            <input name="responsable" value="{{$p->responsable}}" type="text" class="form-control" required>
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

														    	<input type="text" data-key="{{$s->name}}" data-title="{{$s->label}}" value="{{checkValue($p->services,$s->name)}}" class="question form-control" placeholder="{{$s->placeholder}}">
														        
														        @break

														    @case('text-masked')

														    	<input type="text" data-key="{{$s->name}}" data-title="{{$s->label}}" value="{{checkValue($p->services,$s->name)}}" class="masked question form-control" placeholder="{{$s->placeholder}}">
														        
														        @break

														    @case('number')

														    	<input type="number" data-key="{{$s->name}}" data-title="{{$s->label}}" value="{{checkValue($p->services,$s->name)}}" class="question form-control" placeholder="{{$s->placeholder}}">
														        
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
                                    	</div>
                                    </div>

                                    <input name="lat" type="hidden" value="{{$p->lat}}">
                                    <input name="lng" type="hidden" value="{{$p->lng}}">
                                </div>

								<input type='submit' class='btn btn-fill btn-success btn-wd' name='finish' value='Guardar' style="margin: 0;"/>
							</form>
						</div>
					</div>
				</div>
			</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


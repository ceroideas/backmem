<div class="modal fade" id="edit-q-{{$inp->id}}">
	<div class="modal-dialog">
		@if (isset($process))
		<form action="{{url('admin/updateProcess')}}" method="POST" class="modal-content addInput">
		@else
		<form action="{{url('admin/updateService')}}" method="POST" class="modal-content addInput">
		@endif
			{{csrf_field()}}
			<div class="modal-header"></div>
			<div class="modal-body">
			    <div class="creator">
			      <input type="hidden" name="id" value="{{$inp->id}}">

			      <div class="row">
			      	<div class="col-sm-12">
			      		
				      <div class="form-group">
				        <label>Tipo de dato</label>
				        <select name="type" disabled class="form-control" onchange="changeType(this)">
				          {{-- <option value="text">Texto</option> --}}
				          <option {{$inp->type == 'text' ? 'selected' : ''}} value="text">Texto</option>
				          <option {{$inp->type == 'text-masked' ? 'selected' : ''}} value="text-masked">Texto máscara</option>
				          <option {{$inp->type == 'number' ? 'selected' : ''}} value="number">Numérico</option>
				          <option {{$inp->type == 'select' ? 'selected' : ''}} value="select">Selección</option>
				          {{-- <option {{$inp->type == 'checkbox' ? 'selected' : ''}} value="checkbox">Checkbox</option> --}}
				        </select>
				      </div>
			      	</div>
			      	<div class="col-sm-12">
			      		
				      <div class="form-group">
				        <label>Título/Etiqueta</label>
			          <input name="label" class="form-control" required value="{{$inp->label}}">
				        {{-- <input type="text" class="form-control" name="question"> --}}
				      </div>
			      	</div>

			      	<div class="col-sm-12">
				      	<div class="form-group">
				  	        <label>Placeholder</label>
				            <input name="placeholder" class="form-control" required value="{{$inp->placeholder}}"/>
				  	    </div>
			      	</div>

			      	<div class="col-sm-12">
			      		
				      <div class="form-group">
				        <label>Identificador</label>
			          <input name="name" class="form-control" required value="{{$inp->name}}">
				        {{-- <input type="text" class="form-control" name="question"> --}}
				      </div>
			      	</div>
			      	
			      	{{-- <div class="col-sm-12">
				      <div class="form-group">
		                <label for="file">Imagen(Opcional)</label>
		                <input type="file" id="file" class="dropify" name="file" data-height="130" accept="image/*" data-default-file="{{ $inp->file ? $inp->file : '' }}" />
		            </div>
			      	</div> --}}
			      </div>

			      <label><input type="checkbox" name="modify" onclick="modifyOptions(this)" /> Modificar opciones</label>

			      <div class="input-list hidden">

					@if ($inp->type == 'checkbox' || $inp->type == 'select')

					<div class="form-group">
						<label style="display:block; width: 100%; margin-bottom: 15px">Agregar opción <button type="button" onclick="addOption(this)" class="btn btn-xs btn-success pull-right" type=""><i class="fa fa-plus"></i></button></label>
						<ul class="option-list" style="padding-left: 20px">
							@foreach ($inp->options as $op)
								<li class="option-li">
									<div class="form-group">
										<div class="input-group">
											<input type="text" name="options[]" required class="form-control" style="" placeholder="Opción" value="{{$op->value}}" />
										
											<div class="input-group-btn">
												<button onclick="removeOption(this)" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
											</div>
										</div>
									</div>
									
								</li>
							@endforeach
						</ul>

					</div>

					@endif

				  </div>

			    </div>
			    <div class="form-group">
			      <button type="submit" class="btn btn-xs btn-success">Guardar</button>
			      {{-- <button type="button" data-dismiss="modal" class="btn btn-xs btn-warning">Cancelar</button> --}}
			    </div>
			</div>

		</form>
	</div>
</div>	
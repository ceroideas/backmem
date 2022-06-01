<div class="card">
	
	<div class="create-input card-body" style="position: relative; border-bottom: 1px solid #f0f0f0">
		<span onclick="$(this).parent().parent().remove()" style="position: absolute; top: 12px; right: 12px; cursor: pointer; z-index: 9999">x</span>
	@if (isset($id))
	  <form action="{{url('admin/addProcess')}}" method="POST" class="addInput">
	  	<input type="hidden" name="section_id" value="{{$id}}">
	@else
	  <form action="{{url('admin/addService')}}" method="POST" class="addInput">
	@endif
	    {{csrf_field()}}
	    <div class="creator">

	      <div class="row">
	      	<div class="col-sm-12">
	      		
	  	      <div class="form-group">
	  	        <label>Tipo de dato</label>
	  	        <select name="type" class="form-control" onchange="changeType(this)">
	  	          <option value="text">Texto</option>
	  	          <option value="text-masked">Texto máscara</option>
	  	          <option value="number">Numérico</option>
	  	          <option value="select">Selección</option>
	  	          {{-- <option value="checkbox">Checkbox</option> --}}
	  	        </select>
	  	      </div>
	        </div>

	      	<div class="col-sm-12">
	      		
	  	      <div class="form-group">
	  	        <label>Título/Etiqueta</label>
	            <input type="text" name="label" class="form-control" required />
	  	      </div>

	  	      <div class="form-group">
	  	        <label>Placeholder</label>
	            <input type="text" name="placeholder" class="form-control" required />
	  	      </div>

	  	      <div class="form-group">
	  	        <label>Identificador</label>
	            <input type="text" name="name" class="form-control" required />
	  	      </div>

	  	      @if (!isset($id))

		  	      <div class="form-group">
		  	        <label>Editable solo por admin</label>
		            <input type="checkbox" name="only_admin" />
		  	      </div>

		  	  @else

		  	  	<input type="hidden" name="only_admin" value="1">

	  	      @endif
	            
	      	</div>
	      </div>

	      <div class="input-list">
		    </div>
	    </div>
	    <div class="form-group">
	      <button type="submit" class="btn btn-xs btn-success">Guardar</button>
	      {{-- <button type="button" data-dismiss="modal" class="btn btn-xs btn-warning">Cancelar</button> --}}
	    </div>
	  </form>
	</div>
</div>
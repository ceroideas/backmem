<div class="card">
	
	<div class="create-input card-body" style="position: relative; border-bottom: 1px solid #f0f0f0">
		<span onclick="$(this).parent().parent().remove()" style="position: absolute; top: 12px; right: 12px; cursor: pointer; z-index: 9999">x</span>
	  <form action="{{url('admin/addReportInput')}}" method="POST" class="addInput">
	  	<input type="hidden" name="report_section_id" value="{{$id}}">
	    
	    {{csrf_field()}}
	    <div class="creator row">

	      	<div class="col-sm-12">
	      		
	  	      <div class="form-group">
	  	        <label>Numeral</label>
	            <input type="text" name="numeral" class="form-control" />
	  	      </div>

	  	    </div>

	  	    <div class="col-sm-12">
	      		
	  	      <div class="form-group">
	  	        <label>Nombre</label>
	            <input type="text" name="name" class="form-control" required />
	  	      </div>

	  	    </div>

	  	    <div class="col-sm-6">

	  	      <div class="form-group">
	  	        <label>Mínimo</label>
	            <input type="text" name="min" class="form-control" required />
	  	      </div>

	  	    </div>

	  	    <div class="col-sm-6">
	  	      <div class="form-group">
	  	        <label>Máximo</label>
	            <input type="text" name="max" class="form-control" required />
	  	      </div>
	            
	      	</div>

	      	<div class="col-sm-12">
	  	      <div class="form-group">
	  	        <label>Unidad</label>
	            <input type="text" name="unity" class="form-control" required />
	  	      </div>
	            
	      	</div>

	    </div>

	    <div class="form-group">
	      <button type="submit" class="btn btn-xs btn-success">Guardar</button>
	      {{-- <button type="button" data-dismiss="modal" class="btn btn-xs btn-warning">Cancelar</button> --}}
	    </div>
	  </form>
	</div>
</div>
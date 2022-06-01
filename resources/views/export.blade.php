@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Configuración</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Exportar datos</li>
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
                    <h4 class="card-title">Seleccione un método de exportación</h4>
                    <div class="m-t-40">

                    	<div class="row">
                    		<div class="col-3">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Por entidad
                    				</label>
                    				<select class="form-control select2" id="ents">
	                    				<option value=""></option>
	                    				@foreach($ents as $value)
	                    					@if($value)<option>{{$value}}</option>@endif
	                    				@endforeach
                    				</select>
                    			</div>
                    				<button class="btn btn-block btn-info export-btn" style="margin-bottom: 16px;" data-export="entity">EXPORTAR</button>
                    		</div>

                    		<div class="col-3">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Por municipio
                    				</label>
                    				<select class="form-control select2" id="muns">
	                    				<option value=""></option>
	                    				@foreach($muns as $value)
	                    					@if($value)<option>{{$value}}</option>@endif
	                    				@endforeach
                    				</select>
                    			</div>
                    				<button class="btn btn-block btn-info export-btn" style="margin-bottom: 16px;" data-export="municipality">EXPORTAR</button>
                    		</div>

                    		<div class="col-3">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Por código postal
                    				</label>
                    				<select class="form-control select2" id="cps">
	                    				<option value=""></option>
	                    				@foreach($cps as $value)
	                    					@if($value)<option>{{$value}}</option>@endif
	                    				@endforeach
                    				</select>
                    			</div>
                    				<button class="btn btn-block btn-info export-btn" style="margin-bottom: 16px;" data-export="cp">EXPORTAR</button>
                    		</div>

                    		<div class="col-3">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Por responsable
                    				</label>
                    				<select class="form-control select2" id="resp">
	                    				<option value=""></option>
	                    				@foreach($resp as $value)
	                    					@if($value)<option>{{$value}}</option>@endif
	                    				@endforeach
                    				</select>
                    			</div>
                    				<button class="btn btn-block btn-info export-btn" style="margin-bottom: 16px;" data-export="responsable">EXPORTAR</button>
                    		</div>

                    		<div class="col-3">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Por Nivel de cumplimiento
                    				</label>
                    				<select class="form-control select2" id="cump">
	                    				<option value=""></option>
	                    				<option value="1">Cumple con CR</option>
	                    				<option value="2">No Cumple con CR</option>
                    				</select>
                    			</div>
                    				<button class="btn btn-block btn-info export-btn" style="margin-bottom: 16px;" data-export="compliance">EXPORTAR</button>
                    		</div>

                    		<div class="col-3">
                    			<div class="form-group">
                    				<label class="control-label">
                    					Por Status
                    				</label>
                    				<select class="form-control select2" id="sta">
	                    				<option value=""></option>
	                    				<option value="1">Visita a sitio</option>
	                    				<option value="2">Medición servicios interiores</option>
	                    				<option value="3">Medición legal</option>
	                    				<option value="4">Levantamiento</option>
	                    				<option value="5">Estudios y reportes</option>
                    				</select>
                    			</div>
                    				<button class="btn btn-block btn-info export-btn" style="margin-bottom: 16px;" data-export="status">EXPORTAR</button>
                    		</div>
                    	</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

	{{-- /**/ --}}
</div>

@endsection

@section('scripts')
	<script>
		$('.export-btn').click(function (e) {
			e.preventDefault();

			let data = $(this).prev().find('select').val();
			let exp = $(this).data('export');

			if (!data) {return false;}

			window.open('{{url('excel-export')}}/'+exp+'/'+data,'_blank');


		});
	</script>
@endsection

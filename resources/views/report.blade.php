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
                <li class="breadcrumb-item active">Reporte de cumplimiento</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="{{ url('admin/'.$p->id,'points') }}" style="margin-left: 8px;" class="btn btn-xs float-right hidden-sm-down btn-info">Ir a Editar</a>
            <a href="{{ url('admin/'.$p->id,'gathering') }}" class="btn btn-xs float-right hidden-sm-down btn-warning">Ir a Levantamiento</a>
        </div>
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Reporte de cumplimiento del punto</h4>
                    <div class="m-t-40">
                        
                        <form action="{{url('admin/savePointReport',$p->id)}}" method="POST" id="formulario" class="row" style="width: 100%;">
                            {{csrf_field()}}

                            @php
								function checkValueReport($id,$key)
								{

								}
							@endphp
							
							@foreach ($sections as $s)
									<div class="col-sm-12">
										<h4>{{$s->numeral}} - {{$s->name}}</h4>
									</div>

									<div class="col-12">
										
										@foreach ($s->inputs as $pr)
										<div class="row" style="margin-bottom: 8px;">
											
											<div class="col-sm-4">	
												<div class="form-group">
													<label>{{$pr->numeral}} - {{$pr->name}}</label> <br>
													Min: {{$pr->min}} | Max: {{$pr->max}} | Unidad: {{$pr->unity}}
												</div>
											</div>
											<div class="col-sm-5">
												<div class="results" data-id="{{$pr->id}}" data-point_id="{{$p->id}}" id="results-{{$pr->id}}">
													@foreach (App\Models\ReportResult::where(['report_input_id' => $pr->id,'point_id' => $p->id])->get() as $res)

														<div class="form-group result" style="margin-bottom: 8px;">
															<div class="input-group" style=" width: 70%; float: left;">
																<input type="text" name="value" placeholder="Resultado" class="form-control" value="{{$res->value}}">
																<div class="input-group-append">
																    <button type="button" class="btn btn-danger btn-sm" onclick="deleteThis(this)"> x </button>
																</div>
															</div>

															<select name="compliance" class="form-control" style="width: 28%; float: right;">
																<option value=""></option>
																<option {{$res->compliance == 0 ? 'selected' : ''}} value="0">Cumple</option>
																<option {{$res->compliance == 1 ? 'selected' : ''}} value="1">No Cumple</option>
															</select>

															<div style="clear: both"></div>
														</div>

													@endforeach
												</div>
												<button type="button" class="btn btn-info add-input" data-id="{{$pr->id}}" style="margin-bottom: 4px;">Añadir evento</button>
											</div>

											<div class="col-sm-3">
												@php
													$obs = App\Models\ReportObservation::where(['report_input_id' => $pr->id,'point_id' => $p->id])->first();
												@endphp
												<textarea class="form-control observations" data-id="{{$pr->id}}" data-point_id="{{$p->id}}" placeholder="Observaciones">{{$obs ? $obs->value : ''}}</textarea>
											</div>
										<hr>
										</div>
										@endforeach
									</div>
							@endforeach

							{{-- <div class="col-sm-12">
								<i>Nota: Antes de generar un reporte debe guardar la información</i>
								<br>
								<br>
							</div> --}}
							<div class="col-sm-12">
								<button class="btn btn-success" style="margin-right: 4px;">Generar Reporte</button>
								{{-- <a href="{{url('admin',$p->id)}}/pdf-report" class="btn btn-info">Generar Reporte</a> --}}
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
	$('.add-input').click(function(event) {
		
		let html = `
		<div class="form-group result" style="margin-bottom: 8px;">
			<div class="input-group" style=" width: 70%; float: left;">
				<input type="text" name="value" placeholder="Resultado" class="form-control">
				<div class="input-group-append">
				    <button type="button" class="btn btn-danger btn-sm" onclick="deleteThis(this)"> x </button>
				</div>
			</div>

			<select name="compliance" class="form-control" style="width: 28%; float: right;">
				<option value=""></option>
				<option value="0">Cumple</option>
				<option value="1">No Cumple</option>
			</select>

			<div style="clear: both"></div>
		</div>
		`;
		let id = $(this).data('id');

		$('#results-'+id).append(html);
	});

	function deleteThis(t)
	{
		$(t).parents('.form-group').remove();
	}

	$('#formulario').submit(function(event) {
		event.preventDefault();
		let results = [];
		let observations = [];
		$.each($('.results'), function(index, val) {
			let id = $(this).data('id');
			let point_id = $(this).data('point_id');
			$.each($(this).find('.result'), function(index, val) {
				let value = $(this).find('[name="value"]').val();
				let compliance = $(this).find('[name="compliance"]').val();

				results.push({id:id,point_id:point_id,value:value,compliance:compliance});
			});
		});

		$.each($('.observations'), function(index, val) {
			let id = $(this).data('id');
			let point_id = $(this).data('point_id');
			
			observations.push({id:id,point_id:point_id,value:$(this).val()});
		});

		console.log(results,observations);

		$.post('{{url('admin/savePointReport')}}', {_token: '{{csrf_token()}}', point_id: '{{$p->id}}', results: results, observations: observations}, function(data, textStatus, xhr) {
			// Swal.fire({
			//   title:'Datos de reporte guardado!',
			//   icon:'success'
			// });

			// setTimeout(()=>{
				// location.reload();
				window.open('{{url('admin',$p->id)}}/pdf-report','_self');
			// },2000)
		});
	});
</script>
@endsection

@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Indicadores</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Indicadores</li>
            </ol>
        </div>
    </div>

    {{-- /**/ --}}

    <style>
		[contenteditable="true"] {
			border-bottom: 1px dotted #c3c3c3;
		}
		.inner {
		}
		.inner li {
			position: relative;
			margin-bottom: 8px;
		}
		.inner li:hover small.edit, .questions:hover>small {
			display: inline-block;
		}
		.inner li small.edit, .questions>small {
			cursor: pointer;
			color: #58c9f3;
			display: none;
		}

		.inner li ul li:hover small.edit-option {
			display: inline-block;
		}
		.inner li small.edit-option {
			cursor: pointer;
			color: #58c9f3;
			display: none;
		}

		.phases .card-header:hover span small {
			display: inline-block;
		}
		.phases .card-header span small {
			cursor: pointer;
			color: #58c9f3;
			display: none;
		}

		/**/

		.sortable .create-input {
			display: none;
		}
		.sortable small {
			display: none !important;
		}
		.sortable button, .sortable .questions ul, .sortable .questions hr {
			display: none;
		}
		.sortable li {
		  border: 1px dashed #c0c0c0;
		}
		.hidden {
			display: none;
		}

		ul {
			padding: 0;
		}
		.questions {
			list-style: none;
		}
	</style>

	<div class="row">

	<div class="col-sm-8 offset-sm-2">

		<div>

			<div class="row-fluid row" style="margin-bottom: 8px;">
		      <div class="col-md-12">
		      	<a href="javascript:;" id="start-sorting">Modificar orden</a> |
		      	<a href="javascript:;" id="stop-sorting">Terminar de modificar</a>
		      </div>
		  	</div>

			<h3 style="margin-top: 0"> Indicadores de cumplimiento
				<button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#addSection">Crear sección</button>
			</h3>
			

		</div>


		<ul class=" column demo" id="sortable-off">
	        @foreach ($sections as $s)
	          <li class="card phases" data-id="{{$s->id}}" style="width: 100%">
	              <div class="card-header"><span style="font-size: 85%"><span>{{$s->numeral}} - {{$s->name}}</span>
	              	<small class="edit-" data-toggle="modal" data-target="#edit-s-{{$s->id}}">Modifica</small> 
	                <button data-toggle="modal" data-target="#delete-q-{{$s->id}}" class="btn btn-xs btn-danger pull-right" style="margin-left: 4px;" data-id="{{$s->id}}">x</button>
	                @if ($s->report_section_id)
	                	<button class="btn btn-xs btn-info pull-right add-input" data-id="{{$s->id}}">Nuevo indicador</button>
	                @endif
	                @if (!$s->report_section_id)
	                	<button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#addSubSection-{{$s->id}}" style="margin-right: 4px;">Nueva subsección</button>
	                @endif

	                <div class="modal fade" id="edit-s-{{$s->id}}">
						<div class="modal-dialog modal-sm">
							<form class="modal-content" action="{{url('admin/updateSection')}}" method="POST">
								{{csrf_field()}}
								<div class="modal-header">Editar {{$s->name}}</div>
								<div class="modal-body">

									<input type="hidden" name="id" value="{{$s->id}}">

									<div class="form-group">
										<label>Numeral de la subsección</label>
										<input type="text" class="form-control" name="numeral" value="{{$s->numeral}}">
									</div>

									<div class="form-group">
										<label>Nombre de la subsección</label>
										<input type="text" class="form-control" name="name" value="{{$s->name}}">
									</div>

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-xs btn-success">Ok</button>
									<button type="button" data-dismiss="modal" class="btn btn-xs btn-warning">Cancelar</button>
								</div>
							</form>
						</div>
					</div>

	                <div class="modal fade" id="addSubSection-{{$s->id}}">
						<div class="modal-dialog modal-sm">
							<form class="modal-content" action="{{url('admin/addReportSubSection')}}" method="POST">
								{{csrf_field()}}
								<div class="modal-header">Crear subsección para {{$s->name}}</div>
								<div class="modal-body">

									<input type="hidden" name="report_section_id" value="{{$s->id}}">

									<div class="form-group">
										<label>Numeral de la subsección</label>
										<input type="text" class="form-control" name="numeral">
									</div>

									<div class="form-group">
										<label>Nombre de la subsección</label>
										<input type="text" class="form-control" name="name">
									</div>

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-xs btn-success">Ok</button>
									<button type="button" data-dismiss="modal" class="btn btn-xs btn-warning">Cancelar</button>
								</div>
							</form>
						</div>
					</div>

	              </div>
	              @if ($s->report_section_id)
	                <div class="card-body">
	                    <ul class="inner" id="questions-{{$s->id}}">
	                        @foreach ($s->inputs as $inp)
	                            <li class="questions" data-id="{{$inp->id}}">
	                                <span data-id="{{$inp->id}}">
	                                    {{$inp->numeral}} - {{$inp->name}} <br>
	                                    Min: {{$inp->min}} - Max: {{$inp->max}} - Unidad: {{$inp->unity}}
	                                </span>

	                                <small class="edit-" data-toggle="modal" data-target="#edit-q-{{$inp->id}}">Modifica</small> 

	                                @include('edit-indicator')

	                                <small class="pull-right" data-toggle="modal" data-target="#delete-form-{{$inp->id}}" style="position: absolute; top: -6px; right: -3px; cursor: pointer">
	                                    x
	                                </small>
	                                @if (count($s->inputs) > 1)
	                                <hr>
	                                @endif
	                                <div class="modal fade" id="delete-form-{{$inp->id}}">
	                                    <div class="modal-dialog modal-sm">
	                                        <div class="modal-content">
	                                            <div class="modal-header">Eliminar el indicador seleccionada?</div>
	                                            <div class="modal-footer">
	                                                <button type="button" data-id="{{$inp->id}}" class="delete-question btn btn-xs btn-success">
	                                                    Si
	                                                </button>
	                                                <button type="button" data-dismiss="modal" class="btn btn-xs btn-danger">
	                                                    No
	                                                </button>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                            </li>
	                        @endforeach
	                    </ul>
	                </div>
	              @endif
	            </li>
                <div class="modal fade" id="delete-q-{{$s->id}}">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">Eliminar la sección seleccionada?</div>
                            <div class="modal-footer">
                                <button type="button" data-id="{{$s->id}}" class="delete-section btn btn-xs btn-success">
                                    Si
                                </button>
                                <button type="button" data-dismiss="modal" class="btn btn-xs btn-danger">
                                    No
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
	        @endforeach
	      </ul>

	</div>
</div>


	<div class="modal fade" id="addSection">
		<div class="modal-dialog modal-sm">
			<form class="modal-content" action="{{url('admin/addReportSection')}}" method="POST" id="saveStay">
				{{csrf_field()}}
				<div class="modal-header">Crear sección</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Numeral de la sección</label>
						<input type="text" class="form-control" name="numeral">
					</div>

					<div class="form-group">
						<label>Nombre de la sección</label>
						<input type="text" class="form-control" name="name">
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-xs btn-success">Ok</button>
					<button type="button" data-dismiss="modal" class="btn btn-xs btn-warning">Cancelar</button>
				</div>
			</form>
		</div>
	</div>

	{{-- /**/ --}}
</div>

@stop

@section('scripts')

<link rel="stylesheet" href="{{url('drag_drop')}}/draganddrop.css">
<script src="{{url('drag_drop')}}/draganddrop.js" type="text/javascript"></script>

<script>

	var startSorting = function (event) {
		// $(this).css('text-decoration', 'underline');
		$('.demo').sortable({
			group:false,
			same_depth:true,
			update:(a,b)=>{console.log(a,b)}
		});
	}

	var stopSorting = function(event) {
		// $('#start-sorting').css('text-decoration', 'none');
		$('.sortable').each(function() { $(this).sortable('destroy'); });

		let off = [];

		$.each($('#sortable-off .phases'), function(index, val) {
			off.push($(this).data('id'));

			let inp = [];

			$.each($(this).find('.questions'), function(_index, _val) {
				inp.push($(this).data('id'));
			});

			$.post('{{url('admin/changeReortInputOrder')}}', {inputs: inp,_token:'{{csrf_token()}}',section_id:$(this).data('id')}, function(data, textStatus, xhr) {
				console.log('guardado inp');
			});
		});

		console.log(off);
	}

	function saveAjax(event) {

		event.preventDefault();
		console.log('aqui')
		var data = $(this).serializeArray();
		
		$.post($(this).attr('action'), data, function(data, textStatus, xhr) {
			$('.modal').modal('hide');

			setTimeout(()=>{
				setTimeout(()=>{
					location.reload();
				},3000)

				$.toast({
			        heading: 'Completado',
			        text: 'Proceso completado satisfactoriamente',
			        position: 'top-right',
			        loaderBg: '#ff6849',
			        icon: 'info',
			        hideAfter: 3000,
			        stack: 6
			    });

			},300);
		}).fail(e=>{
			let html = "";

			$.each(e.responseJSON.errors, function(index, val) {
				html+="- "+val+"<br>";
			});

			$.toast({
		        heading: 'Error',
		        text: html,
		        position: 'top-right',
		        loaderBg: 'crimson',
		        icon: 'info',
		        hideAfter: 3000,
		        stack: 6
		    });
		});
	}

	function addInput(event) {
		console.log('hola');
		var id = $(this).data('id');
		var v = $('#questions-'+id).find('.create-input');
		if (v.length == 0) {
			$.get('{{url('admin/addReportTemplate')}}/'+id, function(data) {

				$('#questions-'+id).prepend(data);
				
				$('.addInput').unbind('submit');
				$('.addInput').submit(saveAjax);

			});
		}
	}
	$('.add-input').click(addInput);
	$('.addInput').submit(saveAjax);

	$(".delete-question").click(deleteQuestion);

	function deleteQuestion()
	{
		$.get('{{url('admin/deleteReportQuestion')}}/'+$(this).data('id'), function(data, textStatus, xhr) {
			location.reload();
		});
	}

	$(".delete-section").click(deleteSection);

	function deleteSection()
	{
		$.get('{{url('admin/deleteReportSection')}}/'+$(this).data('id'), function(data, textStatus, xhr) {
			location.reload();
		});
	}

	$('#start-sorting').click(startSorting);
	$('#stop-sorting').click(stopSorting);

    // $(".edit-stay").click(startEditStay);

	function removeOption(elem) {
		$(elem).parents('.option-li').remove();
	}
</script>
@endsection
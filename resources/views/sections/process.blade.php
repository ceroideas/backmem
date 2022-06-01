@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Procesos</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Procesos</li>
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

			<h3 style="margin-top: 0"> Procesos operativos
				<button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#addSection">Crear sección</button>
			</h3>
			

		</div>


		<ul class=" column demo" id="sortable-off">
	        @foreach ($sections as $s)
	          <li class="card phases" data-id="{{$s->id}}" style="width: 100%">
	              <div class="card-header"><span style="font-size: 85%"><span>{{$s->name}}</span> 
	              	@if ($s->troublesome)
	              		(Mostrar en problemática)
	              	@endif

	              	@if ($s->status)
	              		(Mostrar en estatus)
	              	@endif
	              	{{-- <small data-id="{{$s->id}}" class="edit-stay">Modifica</small> --}}
	              </span>
	                <button data-toggle="modal" data-target="#delete-q-{{$s->id}}" class="btn btn-xs btn-danger pull-right" style="margin-left: 4px;" data-id="{{$s->id}}">x</button>
	                <button class="btn btn-xs btn-info pull-right add-input" data-id="{{$s->id}}">Nuevo proceso</button>
	                {{-- <button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#crear-input" data-id="{{$s->id}}">Crear input</button> --}}
	              </div>
	                <div class="card-body">
	                    <ul class="inner" id="questions-{{$s->id}}">
	                        @foreach ($s->inputs as $inp)
	                            <li class="questions" data-id="{{$inp->id}}">
	                                <span data-id="{{$inp->id}}">
	                                    {{-- /**/ --}}
	                                    <?php
	                                        echo $inp->label;
	                                    ?>
	                                    (<?php
	                                        echo $inp->name;
	                                    ?>)
	                                </span>

	                                <small class="edit-" data-toggle="modal" data-target="#edit-q-{{$inp->id}}">Modifica</small> 

	                                @include('edit-input', ['process' => true])

	                                <small class="pull-right" data-toggle="modal" data-target="#delete-form-{{$inp->id}}" style="position: absolute; top: -6px; right: -3px; cursor: pointer">
	                                    x
	                                </small>
	                                @if (count($inp->options) > 0)
	                                    <ul style="padding-left: 18px">
	                                        @foreach ($inp->options as $opt)
	                                            <li style="list-style: circle; margin: 0">
	                                                <small>
	                                                    <b>
	                                                        <span class="option">
	                                                            {{$opt->value}}
	                                                        </span>
	                                                    </b>
	                                                </small>
		                                        </li>
		                                      @endforeach
	                                    </ul>
	                                @endif
	                                @if (count($s->inputs) > 1)
	                                <hr>
	                                @endif
	                                <div class="modal fade" id="delete-form-{{$inp->id}}">
	                                    <div class="modal-dialog modal-sm">
	                                        <div class="modal-content">
	                                            <div class="modal-header">Eliminar el proceso seleccionado?</div>
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
			<form class="modal-content" action="{{url('admin/addSection')}}" method="POST" id="saveStay">
				{{csrf_field()}}
				<div class="modal-header">Crear sección</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Nombre de la sección</label>
						<input type="text" class="form-control" name="name">
					</div>

					{{-- <div class="form-group">
						<label>Mostrar en estatus</label> <br>
						<input type="checkbox" name="status">
					</div> --}}

					{{-- <div class="form-group">
						<label>Mostrar en cumplimiento</label> <br>
						<input type="checkbox" name="compliance">
					</div> --}}
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
			group:true,
			same_depth:true,
			update:(a,b)=>{console.log(a,b)}
		});
	}
	var stopSorting = function(event) {
		// $('#start-sorting').css('text-decoration', 'none');
		$('.sortable').each(function() { $(this).sortable('destroy'); });

		// let off = [];
		let inp = [];

		$.each($('#sortable-off .questions'), function(index, val) {
			inp.push($(this).data('id'));
		});

		$.post('{{url('admin/changeProcessOrder')}}', {inputs: inp,_token:'{{csrf_token()}}',section_id:$(this).data('id')}, function(data, textStatus, xhr) {
			console.log('guardado inp');
		});

		console.log(off);
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

			$.post('{{url('admin/changeProcessOrder')}}', {inputs: inp,_token:'{{csrf_token()}}',section_id:$(this).data('id')}, function(data, textStatus, xhr) {
				console.log('guardado inp');
			});
		});

		$.post('{{url('admin/changeSectionOrder')}}', {sections: off,_token:'{{csrf_token()}}'}, function(data, textStatus, xhr) {
			console.log('guardado');
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
				// $('#forms').html(data);

				// $('#start-sorting').click(startSorting);
				// $('#stop-sorting').click(stopSorting);

				// $('.add-input').click(addInput);

				// $(".edit").click(startEditQuestion);
			 //    $(".edit-option").click(startEditOption);

			 //    $(".edit-stay").click(startEditStay);
			 //    $(".delete-question").click(deleteQuestion);

				// $('#crear-fase').modal('hide');
				// $('#crear-estancia').modal('hide');

				$.toast({
			        heading: 'Completado',
			        text: 'Proceso completado satisfactoriamente',
			        position: 'top-right',
			        loaderBg: '#ff6849',
			        icon: 'info',
			        hideAfter: 3000,
			        stack: 6
			    });

				// var notice = PNotify.success({
		  //           title: "Completato",
		  //           text: "Il processo è stato completato con successo!",
		  //           textTrusted: true,
		  //           modules: {
		  //           	Buttons: {
		  //           		closer: false,
		  //           		sticker: false,
		  //           	}
		  //           }
		  //         })
				//   notice.on('click', function() {
				//     notice.close();
				//   });
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

			// var notice = PNotify.error({
	  //           title: "Error",
	  //           text: html,
	  //           textTrusted: true,
	  //           modules: {
	  //           	Buttons: {
	  //           		closer: false,
	  //           		sticker: false,
	  //           	}
	  //           }
	  //         })
			//   notice.on('click', function() {
			//     notice.close();
			//   });
		});
	}

	function addInput(event) {
		var id = $(this).data('id');
		var v = $('#questions-'+id).find('.create-input');
		if (v.length == 0) {
			$.get('{{url('admin/addTemplate')}}/'+id, function(data) {

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
		$.get('{{url('admin/deleteQuestion')}}/'+$(this).data('id'), function(data, textStatus, xhr) {
			location.reload();
		});
	}

	$(".delete-section").click(deleteSection);

	function deleteSection()
	{
		$.get('{{url('admin/deleteSection')}}/'+$(this).data('id'), function(data, textStatus, xhr) {
			location.reload();
		});
	}

	function changeType(elem) {

		var elem = $(elem);

		var html = "";
		
		if ($(elem).val() == 'checkbox' || $(elem).val() == 'radio' || $(elem).val() == 'select') {
			html += '<div class="form-group">\
				<label style="display:block; width: 100%; margin-bottom: 15px">Agregar opción <button type="button" onclick="addOption(this)" class="btn btn-xs btn-success pull-right" type=""><i class="fa fa-plus"></i></button></label>\
				<ul class="option-list" style="padding-left: 20px">\
					<li class="option-li">\
					<div class="form-group">\
						<div class="input-group">';
						
							html+='<input type="text" name="options[]" required class="form-control" placeholder="Opción" />';
						
							html+='<div class="input-group-btn">\
								<button onclick="removeOption(this)" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>';
								
							html+='</div>\
						</div>\
					</div>';
					html+='<ul class="sbopt" style="padding-left: 20px">';
						
					html+='</ul>';
					html+='</li>\
				</ul>';

			html+= '</div>';
			// $(elem).parents('.creator').find('.show-subservice').removeClass('hide');
		}

		$(elem).parents('.creator').find('.input-list').html(html);;
		
	}

	function addOption(elem) {
				
		let a = $(elem).parents('label').next('.option-list').next().find('[type="checkbox"]');

		html = '';

		$(elem).parents('label').next('.option-list').append('<li class="option-li">\
			<div class="form-group">\
				<div class="input-group">\
					<input type="text" name="options[]" required class="form-control" placeholder="Opción" />\
					<div class="input-group-btn">\
						<button onclick="removeOption(this)" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>\
					</div>\
				</div>\
			</div>\
			</li>');
	}

	// var startEditStay = function (e) {
 //        e.stopPropagation();
	// 	editStay(this);
 //    }

	// function editStay(elem) {
	// 	$(elem).prev().attr('contenteditable', 'true');
	// 	$(elem).prev().focus();

	// 	$(elem).prev().click(function(event) {
	//     	event.stopPropagation();
	//     	return false;
	//     });

	//     $('.phases').click(function () {
	//         completeUpdateStay(elem);
	//     });
	// }

	// function completeUpdateStay(elem) {
	// 	$(elem).prev().removeAttr('contenteditable');
	// 	$('.phases').off('click');

	// 	$.post('{{url('admin/updateSection')}}', {_token:'{{csrf_token()}}', name:$(elem).prev().text(), id:$(elem).data('id')}, function(data, textStatus, xhr) {
	// 	});
	// }

	function modifyOptions(elem)
	{
		if ($(elem).is(':checked')) {
			$(elem).parent().next().removeClass('hidden');
			
			$(elem).parents('.creator').find('[name="type"]').prop('disabled',false);

		}else{
			$(elem).parent().next().addClass('hidden');

			$(elem).parents('.creator').find('[name="type"]').prop('disabled',true);
		}
	}

	$('#start-sorting').click(startSorting);
	$('#stop-sorting').click(stopSorting);

    // $(".edit-stay").click(startEditStay);

	function removeOption(elem) {
		$(elem).parents('.option-li').remove();
	}
</script>
@endsection
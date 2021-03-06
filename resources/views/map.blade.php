@extends('layout')

@section('content')

<style>
	#map-locations {
		height: 680px;
	}
	* {
		outline: none !important;
	}
	.gm-style-iw {
		width: 400px;
	}
	.gm-style-iw-d {
		overflow: unset !important;
		margin-bottom: 20px;
	}
	.fl {
		display: inline-flex;
	}
	.legend {
		font-size: 13px;
	}
</style>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Puntos</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Mapa General</b></li>
            </ol>
        </div>
        {{-- <div class="col-md-6 col-4 align-self-center">
            <a href="{{url('admin/customers/new')}}" class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Create</a>
        </div> --}}
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Puntos en el mapa <small>
                    	@if (App\Models\Point::where('lat',null)->count() > 0)
                    		<button id="check-points" class="btn btn-sm btn-warning">Actualmente tienes ({{ App\Models\Point::where('lat',null)->count() }}) puntos sin geolocalización, haz clic aquí para obtenerla</button> </small></h4>
                    	@endif
                    {{-- <h6 class="card-subtitle">Lista de clientes registrados</h6> --}}

                    <div class="row">
                    	<div class="col-sm-3">

                    		<div id="s-normal" class="legend">

                    			@foreach ($customers as $customer)
	                    			<img style="width: 40px; margin: 10px 0" src="{{ url('markers',$customer->marker) }}" alt=""> <span class="fl">{{$customer->name}} <br> {{$customer->points->count()}} puntos </span> <br>
                    			@endforeach

                    		</div>

                    		<div id="s-status" class="legend hide">
                    			
	                    		<img style="width: 40px; margin: 10px 0" src="{{ url('status','1-visita.svg') }}" alt=""> <span class="fl"> Visita al sitio <br> {{App\Models\Point::where('status',1)->count()}} puntos </span> <br>
								<img style="width: 40px; margin: 10px 0" src="{{ url('status','2-medicion.svg') }}" alt=""> <span class="fl"> Medición de servicios interiores <br> {{App\Models\Point::where('status',2)->count()}} puntos </span> <br>
								<img style="width: 40px; margin: 10px 0" src="{{ url('status','3-legal.svg') }}" alt=""> <span class="fl"> Medición legal <br> {{App\Models\Point::where('status',3)->count()}} puntos </span> <br>
								<img style="width: 40px; margin: 10px 0" src="{{ url('status','4-levantamiento.svg') }}" alt=""> <span class="fl"> Levantamiento <br> {{App\Models\Point::where('status',4)->count()}} puntos </span> <br>
								<img style="width: 40px; margin: 10px 0" src="{{ url('status','5-estudios.svg') }}" alt=""> <span class="fl"> Estudios y reportes <br> {{App\Models\Point::where('status',5)->count()}} puntos </span> <br>

                    		</div>

                    		<div id="s-compliance" class="legend hide">
                    			
	                    		<img style="width: 40px; margin: 10px 0" src="{{ url('status','1.svg') }}" alt=""> <span class="fl"> Cumple con CR <br> {{App\Models\Point::where('compliance',1)->count()}} puntos </span> <br>
								<img style="width: 40px; margin: 10px 0" src="{{ url('status','2.svg') }}" alt=""> <span class="fl"> No cumple con CR <br> {{App\Models\Point::where('compliance',2)->count()}} puntos </span> <br>

                    		</div>

                    		<div id="s-troublesome" class="legend hide">
                    			
								<img style="width: 40px; margin: 10px 0" src="{{ url('status','2.svg') }}" alt=""> <span class="fl"> Presentan problemática <br> {{App\Models\Point::whereNotNull('troublesome')->count()}} puntos </span> <br>

                    		</div>

                    	</div>
                    	<div class="col-sm-9">
                    		
		                    <ul class="nav nav-tabs">
							  <li class="nav-item">
							    <span style="cursor: pointer;" onclick="changeSelector('normal')" id="normal" class="nav-link active">Normal</span>
							  </li>
							  <li class="nav-item">
							    <span style="cursor: pointer;" onclick="changeSelector('status')" id="status" class="nav-link">Ver por status</span>
							  </li>
							  <li class="nav-item">
							    <span style="cursor: pointer;" onclick="changeSelector('compliance')" id="compliance" class="nav-link">Ver por nivel de cumplimiento</span>
							  </li>
							  <li class="nav-item">
							    <span style="cursor: pointer;" onclick="changeSelector('troublesome')" id="troublesome" class="nav-link">Presentan problemática</span>
							  </li>
							</ul>

		                    <div id="map-locations">
							</div>
                    	</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

	{{-- /**/ --}}
</div>

{{-- @foreach ($customer->points as $p)
{{$p}} <br>
@endforeach --}}

@endsection

@section('scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATkZiHQhek84RNXwhhzZw8-vtNsK60wAk&libraries=places"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

	var noLatLng = [];

	function initMap(type = 'normal')
	{
		var infowindow = new google.maps.InfoWindow();

		let direccion;
		let geocoder;

		var map = new google.maps.Map(document.getElementById('map-locations'), {
	      zoom: 5,
	      minZoom: 4,
	      center: {lat:25.6490376,lng:-100.44318},
	      // mapTypeControl: false,
		  streetViewControl: false,
		  rotateControl: false,
          mapTypeId: 'roadmap'
	    });

	    @foreach ($customers as $customer)
		    @if (count($customer->points))
		    	@php
		    		$p = $customer->points[0];
		    	@endphp
		    	// map.setCenter({lat: parseFloat('{{$p->lat}}'), lng: parseFloat('{{$p->lng}}')})
		    @endif

		    @if ($customer->points)

				@foreach ($customer->points as $p)

					{{-- direccion = "{{$p->street}}, {{$p->n_exterior}}, {{$p->colony}}, {{$p->municipality}}, {{$p->cp}}";

					geocoder = new google.maps.Geocoder;

					@if (!$p->lat || !$p->lng)

						geocoder
					    .geocode({ address: direccion })
					    .then(({ results }) => {

					      let lat = results[0].geometry.location.lat();
					      let lng = results[0].geometry.location.lng();

					      noLatLng.push({lat:lat,lng:lng,id: {{$p->id}} });

					      // console.log(lat,lng,'{{$p->id}}');

					    })
					    .catch((e) =>
					      console.log("Geocode was not successful for the following reason: " + e)
					    );
					@endif--}}

					var contentString_{{$p->id}} = `
					<div class="row">
						<div class="col-sm-7" style="line-height: 1.4">
							{{$customer->name}} <br>
							`
							if (type == 'troublesome') {
								contentString_{{$p->id}} += `<p><b>{{$p->troublesome}}</b></p>`
							}

							contentString_{{$p->id}} += `
							<b>Entidad:</b> {{$p->entity}} <br>
							<b>Municipio:</b> {{$p->municipality}}<br>
							@if (isset($p->services) && is_array(json_decode($p->services)))
								@foreach (json_decode($p->services,true) as $key => $s)
									<b>{{$s['title']}}:</b> {{$s['value']}} <br>
								@endforeach
							@endif
							<b>Responsable:</b> {{$p->responsable}} <br><br>

							<a target="_blank" class="btn btn-xs btn-success" href="{{url('admin/'.$p->id.'/points')}}">Editar</a>
						</div>
						<div class="col-sm-5" style="text-align: center;">
							@if ($p->image)
								<img src="{{ url('uploads/points',$p->image) }}" style="width: 100%; position: relative;" alt="Imagen">
							@else
								<img src="{{url('frontend')}}/assets/img/default-image.png" style="width: 100%; position: relative;" alt="Sin imagen">
							@endif
						</div>
					</div>`;

					var icon = '{{ url('markers',$customer->marker) }}';

					if (type == 'status') {
						@switch($p->status)
						    @case(1)
						        icon = '{{ url('status','1-visita.svg') }}'
						        @break
						    @case(2)
						        icon = '{{ url('status','2-medicion.svg') }}'
						        @break
						    @case(3)
						        icon = '{{ url('status','3-legal.svg') }}'
						        @break
						    @case(4)
						        icon = '{{ url('status','4-levantamiento.svg') }}'
						        @break
						    @case(5)
						        icon = '{{ url('status','5-estudios.svg') }}'
						        @break
						
						    @default
						        icon = ''
						@endswitch
						
					}
					if (type == 'compliance') {
						@switch($p->compliance)
						    @case(1)
						        icon = '{{ url('status','1.svg') }}'
						        @break
						    @case(2)
						        icon = '{{ url('status','2.svg') }}'
						        @break
						
						    @default
						        icon = ''
						@endswitch
					}

					if (type == 'troublesome') {
						@switch($p->troublesome)
						    @case(!null)
						        icon = '{{ url('status','2.svg') }}'
						        @break
						    @default
						        icon = ''
						@endswitch
					}

				    var marker_{{$p->id}} = new google.maps.Marker({
				      position: {lat: parseFloat('{{$p->lat}}'), lng: parseFloat('{{$p->lng}}')},
				      map: map,
				      icon: {url: icon, scaledSize: new google.maps.Size(60, 60)},
				      // label: {text: /*val.*/sinisters.length.toString(),color: _color,fontSize: '12px',fontWeight: 'bolder'}
				    });

				    marker_{{$p->id}}.addListener('click', function() {
				    	infowindow.close();
						infowindow.setContent(contentString_{{$p->id}});
						infowindow.open(map, marker_{{$p->id}});
					});
				@endforeach
		    @endif
	    @endforeach

	    // setTimeout(()=>{
		   //  if (noLatLng.length) {
			  //   $.post('{{url('saveLatLng')}}', {_token: '{{csrf_token()}}', points: noLatLng}, function(data, textStatus, xhr) {
			  //   	alert('Se ha guardado la información de ubicación de los puntos, se recargará la página.');
			  //   	location.reload();
			  //   });
		   //  }
	    // },4000);

	}

	initMap();

	function changeSelector(t)
	{
		$('.nav-link').removeClass('active');
		$('.legend').addClass('hide');
		$('#'+t).addClass('active');
		$('#s-'+t).removeClass('hide');

		initMap(t);
	}

	const timer = ms => new Promise(res => setTimeout(res, ms));

	async function load(data)
	{
		for (let d of data) {
			direccion = `${d.street}, ${d.n_exterior}, ${d.colony}, ${d.municipality}, ${d.cp}`;

			console.log(direccion);

			geocoder = new google.maps.Geocoder;

			geocoder
		    .geocode({ address: direccion })
		    .then(({ results }) => {

		      let lat = results[0].geometry.location.lat();
		      let lng = results[0].geometry.location.lng();

		      noLatLng.push({lat:lat,lng:lng,id: d.id });

		      console.log(lat,lng,d.id);

		    })
		    .catch((e) =>
		      console.log("Geocode was not successful for the following reason: " + e)
		    );
		    console.log('esperando')
		    await timer(500);
		}

		// $.unblockUI();

		 if (noLatLng.length) {
		    $.post('{{url('saveLatLng')}}', {_token: '{{csrf_token()}}', points: noLatLng}, function(data, textStatus, xhr) {
		    	// alert('Se ha guardado la información de ubicación de los puntos, se recargará la página.');
				alert('Se han obtenido '+noLatLng.length+' nuevas ubicaciones, recargue la página para actualizar resultados.');
		    	// location.reload();
		    });
	    }

	}

	$('#check-points').click(function (e) {

		$.get('{{url('getNullLatLng')}}', function(data) {

			// $.blockUI({ message: '<h1>Obteniendo datos de geolocalización...</h1>' });

			Swal.fire('','Obteniendo los datos de geolocalización, esto puede tardar unos minutos, al finalizar será avisado');

			load(data);
		});
	});
	
</script>
@endsection

<table>
	<thead>
		<tr>
			{{-- <th style="background: #74ab45;"><b>customer_id</b></th> --}}
			<th style="width: 50px;"><b>CALLE</b></th>
			<th><b>Nº EXTERIOR</b></th>
			<th><b>Nº INTERIOR</b></th>
			<th><b>COLONIA</b></th>
			<th><b>CODIGO POSTA</b></th>
			<th><b>ENTIDAD</b></th>
			<th><b>MUNICIPIO O ALCALDIA</b></th>
			<th><b>RESPONSABLE DEL CENTRO DE CARGA</b></th>
			{{-- <th><b>ESTADO</b></th> --}}
			{{-- <th><b>NIVEL DE CUMPLMIENTO</b></th>
			<th><b>PROBLEMATICA</b></th>
			<th><b>LATITUD</b></th>
			<th><b>LONGITUD</b></th> --}}

			@foreach (App\Models\Service::orderBy('order','desc')->get() as $serv)
			@if (!$serv->only_admin)
				<th>
					<b>{{$serv->label}}</b>
				</th>
			@endif
			@endforeach
		</tr>
		<tr>

			{{-- <th style="background: #74ab45;"><b>customer_id</b></th> --}}
			<th style="background: #74ab45;"><b>street</b></th>
			<th style="background: #74ab45;"><b>n_exterior</b></th>
			<th style="background: #74ab45;"><b>n_interior</b></th>
			<th style="background: #74ab45;"><b>colony</b></th>
			<th style="background: #74ab45;"><b>cp</b></th>
			<th style="background: #74ab45;"><b>entity</b></th>
			<th style="background: #74ab45;"><b>municipality</b></th>
			<th style="background: #74ab45;"><b>responsable</b></th>
			{{-- <th style="background: #74ab45;"><b>status</b></th> --}}
			{{-- <th style="background: #74ab45;"><b>compliance</b></th>
			<th style="background: #74ab45;"><b>troublesome</b></th>
			<th style="background: #74ab45;"><b>lat</b></th>
			<th style="background: #74ab45;"><b>lng</b></th> --}}

			@foreach (App\Models\Service::orderBy('order','desc')->get() as $serv)
			@if (!$serv->only_admin)
				<th style="background: {{ $serv->only_admin ? '#ffff01' : '#74ab45' }}">
					<b>service.{{$serv->name}}</b>
				</th>
			@endif
			@endforeach

			{{-- @foreach (App\Models\Section::orderBy('order','desc')->get() as $sect)
				@if ($sect->inputs)
					@foreach ($sect->inputs as $inp)
					<th style="background: #ffff01;">
						<b>process.{{$inp->name}}</b>
					</th>
					@endforeach
				@endif
			@endforeach --}}
		</tr>
	</thead>
</table>
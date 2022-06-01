<table>
	<thead>
		<tr>

			<th><b>Cliente</b></th>
			<th><b>Calle</b></th>
			<th><b>Nº Exterior</b></th>
			<th><b>Nº Interior</b></th>
			<th><b>Colonia</b></th>
			<th><b>Código Postal</b></th>
			<th><b>Entidad</b></th>
			<th><b>Municipio o alcaldía</b></th>
			<th><b>Responsable</b></th>
			<th><b>Status</b></th>
			<th><b>Nivel de cumplimiento</b></th>
			<th><b>Problemática</b></th>
			@foreach (App\Models\Service::orderBy('order','desc')->get() as $serv)
			<th>
				<b>{{$serv->label}}</b>
			</th>
			@endforeach

			@foreach (App\Models\Section::orderBy('order','desc')->get() as $sect)
				@if ($sect->inputs)
					@foreach ($sect->inputs as $inp)
					<th>
						<b>{{$inp->label}}</b>
					</th>
					@endforeach
				@endif
			@endforeach
		</tr>
	</thead>

	<tbody>
		@foreach ($points as $data)
			<tr>
				<td>{{$data->customer->name}}</td>
				<td>{{$data->street}}</td>
				<td>{{$data->n_exterior}}</td>
				<td>{{$data->n_interior}}</td>
				<td>{{$data->colony}}</td>
				<td>{{$data->cp}}</td>
				<td>{{$data->entity}}</td>
				<td>{{$data->municipality}}</td>
				<td>{{$data->responsable}}</td>
				<td>
					@switch($data->status)
					    @case(1)
					        Visita a sitio
					        @break
					    @case(2)
					        Medición servicios interiores
					        @break
					    @case(3)
					        Medidición legal
					        @break
					    @case(4)
					        Levantamiento
					        @break
					    @case(5)
					        Estudios y reportes
					        @break
					    {{-- @default
					            Default case... --}}
					@endswitch
					
				</td>
				<td>{{$data->compliance == 1 ? 'Cumple con CR' : 'No cumple con CR'}}</td>
				<td>{{$data->troublesome ? $data->troublesome : 'Sin problemática'}}</td>
				@foreach (App\Models\Service::orderBy('order','desc')->get() as $serv)
				<td>
					{{$data->getServiceValue($serv->name)}}
				</td>
				@endforeach

				@foreach (App\Models\Section::orderBy('order','desc')->get() as $sect)
					@if ($sect->inputs)
						@foreach ($sect->inputs as $inp)
						<td>
							{{$data->getProcessValue($inp->name)}}
						</td>
						@endforeach
					@endif
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>
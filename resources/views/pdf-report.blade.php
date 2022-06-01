<style>
	* {
		font-family: helvetica;
		font-size: 12px;
	}
	table {width: 100%;}
	thead th {
		background-color: #8da3ba;
		color: #fff;
	}
	.bordered td {
		border: 2px solid silver;
	}
	#footer { position: fixed; right: 0px; bottom: 10px; text-align: center; }
        #footer .page:after { content: counter(page, decimal); }
 	@page { margin: 20px 30px 40px 50px; }
</style>

@php
	function checkValue($services,$key)
	{
		$services = json_decode($services,true);
		if (isset($services)) {
			foreach ($services as $s) {
				if ($s['key'] == $key) {
					return $s['value'];
				}
			}
		}
	}
@endphp

<div id="footer">
	<p class="page">Pag </p>
</div> 

<h1 style="margin-top: 0; font-size: 18px;">Resumen de resultados de parámetros de cumplimiento de Código de Red <br>
	CitiBanamex &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	SUC. SAN FRANCISCO
</h1>

Nivel de Tensión: {{checkValue($p->services,'tension')}} Kv<br>
Tarifa: {{checkValue($p->services,'tariff')}}<br>
RMU: {{checkValue($p->services,'register')}}<br>
Nº Medidor: {{checkValue($p->services,'measurer')}}<br>
Building code: 26595 <br>
PR-20037

<span style="float:right;">{{Carbon\Carbon::today()->format('d-M-Y')}}</span>

<table>
	<thead>
		<tr>
			<th>Numeral</th> 
			<th width="20%">Concepto</th>
			<th>Min</th>
			<th>Max</th>
			<th>Unidades</th>
			<th width="20%">Resultado</th>
			<th width="10%">Cumplimiento <br> Código de Red</th>
			<th width="28%">Observaciones</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td></td>
			<td colspan="7">
				<b>MANUAL DE INTERCONEXIÓN Y PUNTOS QUE DEBERAN DE CUMPLIR LOS CENTROS DE CARGA</b>
			</td>
		</tr>
	
		@foreach ($sections as $s)

			@if ($s->numeral || $s->name)
				<tr>
					<td style="text-align: center"><b>{{$s->numeral}}</b></td>
					<td colspan="7"><b>{{$s->name}}</b></td>
				</tr>
			@endif
			@if ($s->inputs->count())
				@foreach ($s->inputs as $i)
					<tr class="bordered">
						<td style="text-align: center">{{$i->numeral}}</td>
						<td style="padding: auto 8px;">{{$i->name}}</td>
						<td style="padding: auto 8px;text-align: center">{{$i->min}}</td>
						<td style="padding: auto 8px;text-align: center">{{$i->max}}</td>
						<td style="padding: auto 8px;text-align: center">{{$i->unity}}</td>

						@php
							$results = App\Models\ReportResult::where(['report_input_id' => $i->id,'point_id' => $p->id])->get();
						@endphp
						<td colspan="2" style="padding: 0 !important; {{count($results) > 1 ? 'border: none !important' : 'border: 2px solid silver; border-right: none !important'}};">

							@if ($results)
								<table cellpadding="8" cellspacing=".5">
								@if (count($results) > 1)
									@foreach ($results as $key => $res)
										<tr>
											<td width="15%">L{{$key+1}}</td>
											<td width="50%">{{$res->value}}</td>

											<td style="text-align: center; border: 2px solid silver;">{{$res->compliance == 1 ? 'No cumple' : 'Cumple'}}</td>
											<td style="border: 0px solid silver; width: 20px; background-color: {{$res->compliance == 1 ? 'red' : '#9fd25c'}};">&nbsp;&nbsp;&nbsp;&nbsp;</td>
										</tr>
									@endforeach
								@elseif(count($results) == 1)
									<tr>
										<td width="156px" style="border: none !important;">{{$results[0]->value}}</td>
										<td style="text-align: center; border: none !important; border-left: 2px solid silver; border-right: 2px solid silver;">{!!$results[0]->compliance == 1 ? 'No cumple' : 'Cumple'!!}</td>
										<td style="border: none !important; border-left: 0px solid silver; width: 20px; background-color: {{$results[0]->compliance == 1 ? 'red' : '#9fd25c'}};">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
								@endif
								</table>
							@endif
						{{-- </td> --}}

						{{-- @php
							$results = App\Models\ReportResult::where(['report_input_id' => $i->id,'point_id' => $p->id])->get();
						@endphp --}}
						{{-- <td style="padding: 0 !important; border: {{count($results) > 1 ? 'none !important' : '2px solid silver'}};"> --}}

							{{-- @if ($results)
								<table cellpadding="8" cellspacing="0">
								@foreach ($results as $key => $res)
									<tr>
										<td style="border: {{count($results) > 1 ? '2px solid silver' : 'none !important'}};">{{$res->compliance == 1 ? 'No cumple' : 'Cumple'}}</td>
										<td style="border: {{count($results) > 1 ? '2px solid silver' : 'none !important'}}; width: 20px; background-color: {{$res->compliance == 1 ? 'red' : '#9fd25c'}};">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
								@endforeach
								</table>
							@endif --}}
						</td>
						<td style="padding: auto 8px;">
							@php
								$obs = App\Models\ReportObservation::where(['report_input_id' => $i->id,'point_id' => $p->id])->first();
							@endphp
							{!!$obs ? nl2br($obs->value) : ''!!}
						</td>
					</tr>
				@endforeach
			@endif


		@endforeach
		
	</tbody>
</table>
		<br>

		<b>Notas:</b> <br>
		Numeral*: Se refiere a la información contenida en Manual de requerimientos Técnicos para la conexión de Centros de Carga, incluido en la Resolución RES/550/2021
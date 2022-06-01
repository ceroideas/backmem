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
                <li class="breadcrumb-item active">Puntos</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="{{url('admin/points/new')}}" class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Crear</a>
        </div>
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listar</h4>
                    <h6 class="card-subtitle">Lista de clientes registrados</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
									<th>Calle</th>
									<th>Nº Exterior</th>
									<th>Nº Interior</th>
									<th>colonia</th>
									<th>Código Postal</th>
									<th>Entidad</th>
									<th>Municipio o Alcaldía</th>
									<th>Responsable</th>
									<th>Imágen</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($p as $pp)
                                    <tr>
                                        <td>{{$pp->customer->user->name}}</td>
										<td>{{$pp->street}}</td>
										<td>{{$pp->n_exterior}}</td>
										<td>{{$pp->n_interior}}</td>
										<td>{{$pp->colony}}</td>
										<td>{{$pp->cp}}</td>
										<td>{{$pp->entity}}</td>
										<td>{{$pp->municipality}}</td>
										<td>{{$pp->responsable}}</td>
										<td>
                                            @if ($pp->image)
                                                <img src="{{ url('uploads/points',$pp->image) }}" style="height: 40px;"></td>
                                            @endif
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ url('admin/'.$pp->id.'/points') }}">Editar</a>
                                            <a class="btn btn-xs btn-warning" href="{{ url('admin/'.$pp->id.'/gathering') }}">Levantamiento</a>
                                            <a class="btn btn-xs btn-success" href="{{ url('admin/'.$pp->id.'/report') }}">Reportear</a>
                                            <a class="btn btn-xs btn-danger" data-toggle="modal" href="#delete-{{$pp->id}}">Eliminar</a>

                                            <div class="modal fade" id="delete-{{$pp->id}}">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">Desea eliminar el punto seleccionado?</div>
                                                        <div class="modal-footer"><a href="{{ url('admin/'.$pp->id.'/delete_point') }}" class="btn btn-sm btn-success">Si</a>
                                                            <button class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

	{{-- /**/ --}}
</div>

@endsection

@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Clientes</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="{{url('admin/customers/new')}}" class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Crear</a>
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
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Imagen</th>
                                    <th>Marcador</th>
                                    <th>Status</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($c as $cc)
                                    <tr>
                                        <td>{{$cc->id}}</td>
                                        <td>{{$cc->name}}</td>
                                        <td>{{$cc->user->email}}</td>
                                        <td>
                                            @if ($cc->image)
                                                <img src="{{ url('uploads/customers',$cc->image) }}" style="height: 40px;">
                                            @endif
                                        </td>
                                        <td><img src="{{ url('markers',$cc->marker) }}" style="height: 40px;"> {{$cc->points->count()}} </td>
                                        <td>{{$cc->status ? 'Activo' : 'Inactivo'}}</td>
                                        <td>
                                            <a href="{{url('admin/customers/edit',$cc->user_id)}}" class="btn btn-info btn-sm">Editar</a>
                                            <a href="{{url('admin/customers/points',$cc->id)}}" class="btn btn-success btn-sm">Puntos</a>
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

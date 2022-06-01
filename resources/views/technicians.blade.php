@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Técnicos</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Técnicos</li>
            </ol>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <a href="{{url('admin/technicians/new')}}" class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Crear</a>
        </div>
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listar</h4>
                    <h6 class="card-subtitle">Lista de técnicos registrados</h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tech as $t)
                                    <tr>
                                        <td>{{$t->id}}</td>
                                        <td>{{$t->name}}</td>
                                        <td>{{$t->email}}</td>
                                        <td>{{$t->status ? 'Activo' : 'Inactivo'}}</td>
                                        <td>
                                            <a href="{{url('admin/technicians/edit',$t->id)}}" class="btn btn-info btn-sm">Editar</a>
                                            <a href="#delete-{{$t->id}}" data-toggle="modal" class="btn btn-danger btn-sm">Borrar</a>

                                            <div class="modal fade" id="delete-{{$t->id}}">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Borrar el técnico seleccionado
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{url('admin/technicians/delete',$t->id)}}" class="btn btn-sm btn-success">Borrar</a>
                                                            <button data-dismiss="modal" class="btn btn-sm btn-danger">Cancelar</button>
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

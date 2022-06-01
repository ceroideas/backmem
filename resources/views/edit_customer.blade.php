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
                <li class="breadcrumb-item active">Editar Cliente</li>
            </ol>
        </div>
        {{-- <div class="col-md-6 col-4 align-self-center">
            <button class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Create</button>
        </div> --}}
    </div>

    {{-- /**/ --}}

	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar cliente</h4>
                    <div class="m-t-40">
                        
                        <form action="{{url('admin/customers/update',$cc->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                        	<div class="row">

                        		<div class="col-sm-6">
		                        	<div class="form-group">
		                        		<label>Nombre del cliente</label>
		                        		<input type="text" name="name" value="{{$cc->name}}" class="form-control" required>
		                        	</div>
                        		</div>

                        		<div class="col-sm-6">
		                        	<div class="form-group">
		                        		<label>Email</label>
		                        		<input type="email" name="email" value="{{$cc->email}}" class="form-control" required>
		                        	</div>
                        		</div>

                        		<div class="col-sm-6">
		                        	<div class="form-group">
		                        		<label>Contraseña</label>
		                        		<input type="password" name="password" value="" class="form-control">
		                        	</div>
                        		</div>

                        		<div class="col-sm-3">
		                        	<div class="form-group">
		                        		<label>Color del marcador</label>
		                        		<input type="color" name="color" value="{{$cc->customer->color}}" class="form-control" value="#ffffff">
		                        	</div>
                        		</div>

                        		<div class="col-sm-3">
		                        	<div class="form-group">
		                        		<label>Imagen</label>
		                        		<input type="file" name="image" class="form-control">

		                        		<img src="{{url('uploads/customers',$cc->customer->image)}}" alt="" style="width: 80px;">
		                        	</div>
                        		</div>

                        		<div class="col-sm-12">
		                        	<div class="form-group">
		                        		<label>Activar</label> <br>
		                        		<input type="checkbox" name="status" {{$cc->customer->status ? 'checked' : ''}}>
		                        	</div>
                        		</div>


                        		<div class="col-sm-12">
                        			<button class="btn btn-success">Guardar</button>
                        		</div>
                        		

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

@extends('layout')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Dashboard</h3>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            {{-- <a href="{{url('admin/points/new')}}" class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Crear nuevo punto</a> --}}
        </div>
    </div>

    {{-- /**/ --}}

	<div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 style="min-height: 44px;" class="card-title">Clientes totales registrados</h4>
                    <div class="text-right">
                        <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> {{App\Models\Customer::count()}}</h2>
                        {{-- <span class="text-muted">Todays Income</span> --}}
                    </div>
                </div>
            </div>
        </div>

		<div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 style="min-height: 44px;" class="card-title">Clientes registrados esta semana</h4>
                    <div class="text-right">
                        <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> {{App\Models\Customer::where('created_at','>',Carbon\Carbon::today()->startOfWeek())->count()}}</h2>
                        {{-- <span class="text-muted">Todays Income</span> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 style="min-height: 44px;" class="card-title">Todos los puntos registrados</h4>
                    <div class="text-right">
                        <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> {{App\Models\Point::count()}}</h2>
                        {{-- <span class="text-muted">Todays Income</span> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 style="min-height: 44px;" class="card-title">Puntos nuevos ésta semana</h4>
                    <div class="text-right">
                        <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> {{App\Models\Point::where('created_at','>',Carbon\Carbon::today()->startOfWeek())->count()}}</h2>
                        {{-- <span class="text-muted">Todays Income</span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
    		
    		<a href="{{url('admin/general-map')}}" class="btn btn-info">Ver el mapa general</a>

    	</div>
    </div>

	{{-- /**/ --}}
</div>

@endsection

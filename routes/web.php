<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', ['uses' => function () {
    return view('login');
}, 'as' => 'login']);

Route::post('login', [UserController::class, 'login']);
Route::post('send-code', [MainController::class, 'sendCode']);
Route::post('change-password', [MainController::class, 'changePassword']);

Route::get('/recuperar-contrasena', [MainController::class, 'recuperarContrasena']);
Route::get('/registro', [MainController::class, 'index']);

Route::get('/offline-form', [MainController::class, 'indexOffline']);

Route::get('/', [MainController::class, 'main']);

Route::post('/main-login', [MainController::class, 'mainLogin']);
// Route::post('/file_store', [MainController::class, 'file_store']);


Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin'], function() {
    //
    Route::get('/', function () {
	    return view('dashboard');
	});

	Route::get('technicians', [MainController::class, 'technicians']);
	Route::get('technicians/new', [MainController::class, 'techniciansNew']);
	Route::get('technicians/edit/{id}', [MainController::class, 'techniciansEdit']);
	Route::post('technicians', [MainController::class, 'techniciansAdd']);
	Route::post('technicians/update/{id}', [MainController::class, 'techniciansUpdate']);


	Route::get('customers', [MainController::class, 'customers']);
	Route::get('customers/new', [MainController::class, 'customersNew']);
	Route::get('customers/edit/{id}', [MainController::class, 'customersEdit']);
	Route::get('customers/points/{id}', [MainController::class, 'map']);
	Route::post('customers', [MainController::class, 'customersAdd']);
	Route::post('customers/update/{id}', [MainController::class, 'customersUpdate']);
	Route::get('points', [MainController::class, 'points']);
	Route::post('points', [MainController::class, 'savePoint']);
	Route::post('points/{id}', [MainController::class, 'updatePoint']);
	Route::get('points/new', [MainController::class, 'pointsNew']);
	Route::get('{id}/points', [MainController::class, 'pointsEdit']);
	Route::get('{id}/report', [MainController::class, 'pointsReport']);
	Route::get('{id}/gathering', [MainController::class, 'pointsGathering']);
	Route::get('{id}/delete_point', [MainController::class, 'pointsDelete']);
	Route::get('{id}/pdf-report', [MainController::class, 'pointsPdfReport']);
	Route::get('services', [MainController::class, 'services']);
	Route::get('process', [MainController::class, 'process']);
	Route::get('indicators', [MainController::class, 'indicators']);
	Route::get('general-map', [MainController::class, 'generalMap']);
	Route::get('import', [MainController::class, 'import']);
	Route::get('export', [MainController::class, 'export']);

	Route::get('createSvg', [MainController::class, 'createSvg']);


	Route::get('addTemplate/{id?}', [MainController::class, 'addTemplate']);

	Route::post('addService', [MainController::class, 'addService']);
	Route::post('updateService', [MainController::class, 'updateService']);
	Route::post('changeServiceOrder', [MainController::class, 'changeServiceOrder']);


	Route::post('addSection', [MainController::class, 'addSection']);
	Route::post('addProcess', [MainController::class, 'addProcess']);
	Route::post('updateProcess', [MainController::class, 'updateProcess']);
	Route::get('deleteService/{id}', [MainController::class, 'deleteService']);

	Route::post('changeProcessOrder', [MainController::class, 'changeProcessOrder']);
	Route::post('changeSectionOrder', [MainController::class, 'changeSectionOrder']);

	Route::get('deleteQuestion/{id}', [MainController::class, 'deleteQuestion']);
	Route::get('deleteSection/{id}', [MainController::class, 'deleteSection']);

	Route::get('addReportTemplate/{id?}', [MainController::class, 'addReportTemplate']);
	Route::post('addReportSection', [MainController::class, 'addReportSection']);
	Route::post('addReportSubSection', [MainController::class, 'addReportSubSection']);
	Route::post('addReportInput', [MainController::class, 'addReportInput']);
	Route::post('updateReportInput/{id}', [MainController::class, 'updateReportInput']);
	Route::post('updateSection', [MainController::class, 'updateSection']);

	Route::post('savePointReport', [MainController::class, 'savePointReport']);
	
	Route::get('deleteReportSection/{id}', [MainController::class, 'deleteReportSection']);
});
	Route::get('migrar', [MainController::class, 'migrar']);

Route::post('points-front', [MainController::class, 'savePointCustomer']);
Route::post('savepoint-front', [MainController::class, 'savePointFront']);
Route::post('updatepoint-front', [MainController::class, 'updatePointFront']);

Route::get('excel-export/{exp}/{data}', [MainController::class, 'excelExport']);
Route::post('excel-import', [MainController::class, 'excelImport']);
Route::get('excel-sample', [MainController::class, 'excelSample']);
	
Route::get('logout', [MainController::class, 'logout']);

Route::post('saveLatLng', [MainController::class, 'saveLatLng']);

Route::get('getNullLatLng', [MainController::class, 'getNullLatLng']);


/**/

Route::post('select-customer', [MainController::class, 'selectCustomer']);

Route::post('saveSurvey/{id}', [MainController::class, 'saveSurvey']);
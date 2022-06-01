<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Point;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\Process;
use App\Models\ProcessOption;
use App\Models\Customer;
use App\Models\Section;
use App\Models\ReportSection;
use App\Models\ReportInput;
use App\Models\ReportObservation;
use App\Models\ReportResult;
use App\Models\Survey;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Exports\ReportExport;
use App\Exports\SampleExport;

use App\Imports\ReportImport;
use App\Imports\SheetImport;

use Illuminate\Support\Str;

use Carbon\Carbon;

use Auth;
use Excel;
use Validator;
use PDF;
use Mail;

class MainController extends Controller
{
    //
    public function indexOffline()
    {
    	return view('offline-form');
    }
    public function recuperarContrasena()
    {
    	return view('main-recover');
    }
    public function changePassword(Request $r)
    {
    	$this->validate($r,[
			'password' => 'required|confirmed'
		],[
			'password.required' => 'La contraseña es requerida',
			'password.confirmed' => 'Las contraseñas no coinciden'
		]);

		$u = User::find($r->user_id);
		$u->password = bcrypt($r->password);
		$u->save();

    	return $r->all();
    }
    public function excelSample()
    {
    	return (new SampleExport)->download('importacion-muestra-'.Carbon::now()->format('d-m-Y H:i').'.xlsx');

    	// return Excel::download(new SampleExport, );
    }
    public function excelExport($exp,$data)
    {
    	return Excel::download(new ReportExport($exp,$data), 'exportacion-'.$exp.'-'.Carbon::now()->format('d-m-Y H:i').'.xlsx');
    }
    public function excelImport(Request $r)
    {
    	$customer = null;
		if (Auth::user()->customer) {
			$customer = Auth::user()->customer;
		}
		if (session('customer')) {
			$customer = session('customer');
		}

    	$import = new SheetImport($customer->id);

    	$import->onlySheets(1);

		Excel::import($import, request()->file('excel'));
		return back();
    }
    public function index()
    {
    	if (Auth::check()) {
    		if (Auth::user()->role_id == -1) {
    			return redirect('admin');
    		}
    		return redirect('customer');
    	}
    	Auth::logout();
    	return view('index');
    }
    public function logout()
    {
    	session()->forget('customer');
    	Auth::logout();

    	return redirect('/');
    }
	public function customers()
	{
		$c = Customer::all();
		return view('customers', compact('c'));
	}
	public function points()
	{
		$p = Point::all();
		return view('points', compact('p'));
	}

	public function main()
	{
		if (Auth::check()) {
			if (Auth::user()->role_id == -1) {
				return redirect('admin');
			}
			if (Auth::user()->role_id == 0) {
				return view('technician');
			}
			return view('customer');
		}
		Auth::logout();
		return view('main-login');
	}

	public function mainLogin(Request $r)
	{
		// Auth::loginUsingId(User::where('email','rolando.garcia@eurecat.org')->first()->id);
		// return redirect('customer');

		if (Auth::attempt(['email' => $r->email, 'password' => $r->password, 'role_id' => 1],true)) {
			
			return redirect('/');
		}else if (Auth::attempt(['email' => $r->email, 'password' => $r->password, 'role_id' => 0],true)) {
			return redirect('/');
		}
		return response()->json(['errors'=>['error' =>['Los datos ingresados son incorrectos.']]],422);
	}

	public function sendCode(Request $r)
    {
        $u = User::where('email',$r->email)->first();

        if (!$u) {
            return response()->json(['errors'=>[['Error, el email igresado no existe, intente nuevamente']]],422); 
        }

        $data = [
            'u' => $u,
            'token' => $r->code
        ];

        $m = Mail::send('recover', $data, function ($message) use($u, $r) {
            $message->to($r->email , $u->name);
            $message->subject('Restablecer contraseña'); 
        });

        return $u;
    }

	public function pointsEdit($id)
	{
		$p = Point::find($id);
		$customers = Customer::all();
		$services = Service::orderBy('order','desc')->get();
		$sections = Section::orderBy('order','desc')->get();

		return view('edit_point', compact('p','customers','services','sections'));
	}

	public function pointsReport($id)
	{
		$p = Point::find($id);
		$sections = ReportSection::orderBy('order','desc')->get();

		ReportResult::where('point_id',$p->id)->delete();
		ReportObservation::where('point_id',$p->id)->delete();

		return view('report', compact('p','sections'));
	}

	public function pointsPdfReport($id)
	{
		$p = Point::find($id);
		$sections = ReportSection::orderBy('order','desc')->get();
		// return view('pdf-report', compact('p','sections'));


		$pdf = PDF::setOptions(['isPhpEnabled' => false])->setPaper('legal', 'landscape');

		$pdf->loadView('pdf-report', compact('p','sections'));

		return $pdf->download( Str::slug('reporte punto '.$p->id.' '.$p->customer->name.' '.Carbon::now()->format('d-m-Y H_i_s'),'-').'.pdf');
	}

	public function savePointCustomer(Request $r)
	{
		$this->validate($r,[
			'email' => 'required|unique:users'
		],[
			'email.unique' => 'El email ya está en uso'
		]);

		$name1 = "";
		$name2 = "";

		if ($r->hasFile('user_image')) {
			$file = $r->file('user_image');
            $path = public_path().'/uploads/customers';
            $name1 = $file->getClientOriginalName();
            $file->move($path,$name1);
		}

		if ($r->hasFile('point_image')) {
			$file = $r->file('point_image');
            $path = public_path().'/uploads/points';
            $name2 = $file->getClientOriginalName();
            $file->move($path,$name2);
		}

		$u = new User;
		$u->name = $r->name;
		$u->email = $r->email;
		$u->password = bcrypt($r->password);
		$u->role_id = 1;
		$u->save();

		Auth::loginUsingId($u->id);

		$c = new Customer;
		$c->name = $r->name;
		$c->user_id = $u->id;
		$c->image = $name1;
		$c->color = $r->color;
		$c->marker = $this->createSvg($r->color);
		$c->status = 1; //$r->status ? 1 : 0;
		$c->save();

		if ($r->hasFile('excel')) {
			
			$import = new SheetImport($c->id);
	    	$import->onlySheets(1);

	    	Excel::import($import, request()->file('excel'));

		}else{
			
			$p = new Point;
			$p->customer_id = $c->id;

			$p->street = $r->street;
			$p->n_exterior = $r->n_exterior;
			$p->n_interior = $r->n_interior;
			$p->colony = $r->colony;
			$p->cp = $r->cp;
			$p->entity = $r->entity;
			$p->municipality = $r->municipality;
			$p->responsable = $r->responsable;
			$p->image = $name2;
			$p->lat = $r->lat;
			$p->lng = $r->lng;

			$p->services = $r->services;

			$p->save();
		}


		// return redirect('/')->with('message','completado');
	}


	public function savePoint(Request $r)
	{
		$name1 = "";

		if ($r->hasFile('point_image')) {
			$file = $r->file('point_image');
            $path = public_path().'/uploads/points';
            $name1 = $file->getClientOriginalName();
            $file->move($path,$name1);
		}

		if ($r->hasFile('signature')) {
			$file = $r->file('signature');
            $path = public_path().'/uploads/points/signatures';
            $sign = uniqid().$file->getClientOriginalName();
            $file->move($path,$sign);
		}

		$p = new Point;

		if ($r->hasFile('aditional_file')) {
			$file = $r->file('aditional_file');
            $path = public_path().'/uploads/points/aditional_file';
            $aditional_file = $file->getClientOriginalName();
            $file->move($path,$aditional_file);
		}

		$p = new Point;
		
		$p->customer_id = $r->customer_id;

		$p->street = $r->street;
		$p->n_exterior = $r->n_exterior;
		$p->n_interior = $r->n_interior;
		$p->colony = $r->colony;
		$p->cp = $r->cp;
		$p->entity = $r->entity;
		$p->municipality = $r->municipality;
		$p->responsable = $r->responsable;
		$p->image = $name1;
		$p->lat = $r->lat;
		$p->lng = $r->lng;

		$p->status = $r->status;
		$p->compliance = $r->compliance;

		$p->services = $r->services;
		$p->processes = $r->processes;
		$p->measuring = $r->measuring;
		$p->sign = $sign;
		$p->aditional_file = $aditional_file;

		$p->troublesome = $r->troublesome;

		$p->save();

		return ['url'=>url('admin/points')];
	}

	public function savePointFront(Request $r)
	{
		$name1 = "";

		if ($r->hasFile('point_image')) {
			$file = $r->file('point_image');
            $path = public_path().'/uploads/points';
            $name1 = $file->getClientOriginalName();
            $file->move($path,$name1);
		}

		$p = new Point;
		
		$p->customer_id = $r->customer_id;

		$p->street = $r->street;
		$p->n_exterior = $r->n_exterior;
		$p->n_interior = $r->n_interior;
		$p->colony = $r->colony;
		$p->cp = $r->cp;
		$p->entity = $r->entity;
		$p->municipality = $r->municipality;
		$p->responsable = $r->responsable;
		$p->image = $name1;
		$p->lat = $r->lat;
		$p->lng = $r->lng;

		$p->services = $r->services;

		$p->save();

		$customer = null;
		if (Auth::user()->customer) {
			$customer = Auth::user()->customer;
		}
		if (session('customer')) {
			$customer = session('customer');
		}

		return ['view'=>view('table', compact('customer'))->render(), 'message'=>'Punto guardado correctamente'];
	}

	public function updatePointFront(Request $r)
	{
		$name1 = "";

		$p = Point::find($r->id);

		if ($r->hasFile('point_image')) {
			$file = $r->file('point_image');
            $path = public_path().'/uploads/points';
            $name1 = $file->getClientOriginalName();
            $file->move($path,$name1);
			$p->image = $name1;
		}

		
		// $p->customer_id = $r->customer_id;

		$p->street = $r->street;
		$p->n_exterior = $r->n_exterior;
		$p->n_interior = $r->n_interior;
		$p->colony = $r->colony;
		$p->cp = $r->cp;
		$p->entity = $r->entity;
		$p->municipality = $r->municipality;
		$p->responsable = $r->responsable;
		$p->lat = $r->lat;
		$p->lng = $r->lng;

		$p->services = $r->services;

		$p->save();

		$customer = null;
		if (Auth::user()->customer) {
			$customer = Auth::user()->customer;
		}
		if (session('customer')) {
			$customer = session('customer');
		}

		return ['view'=>view('table', compact('customer'))->render(), 'message'=>'Punto guardado correctamente'];
	}

	public function updatePoint(Request $r,$id)
	{
		$name1 = "";

		$p = Point::find($id);

		if ($r->hasFile('point_image')) {
			$file = $r->file('point_image');
            $path = public_path().'/uploads/points';
            $name1 = $file->getClientOriginalName();
            $file->move($path,$name1);

            $p->image = $name1;
		}

		if ($r->hasFile('signature')) {
			$file = $r->file('signature');
            $path = public_path().'/uploads/points/signatures';
            $sign = uniqid().$file->getClientOriginalName();
            $file->move($path,$sign);

            $p->sign = $sign;
		}

		if ($r->hasFile('aditional_file')) {
			$file = $r->file('aditional_file');
            $path = public_path().'/uploads/points/aditional_file';
            $aditional_file = $file->getClientOriginalName();
            $file->move($path,$aditional_file);

            $p->aditional_file = $aditional_file;
		}

		
		$p->customer_id = $r->customer_id;

		$p->street = $r->street;
		$p->n_exterior = $r->n_exterior;
		$p->n_interior = $r->n_interior;
		$p->colony = $r->colony;
		$p->cp = $r->cp;
		$p->entity = $r->entity;
		$p->municipality = $r->municipality;
		$p->responsable = $r->responsable;
		
		$p->lat = $r->lat;
		$p->lng = $r->lng;

		$p->services = $r->services;
		$p->processes = $r->processes;

		$p->status = $r->status;
		$p->compliance = $r->compliance;
		$p->measuring = $r->measuring;

		$p->troublesome = $r->troublesome;

		$p->save();

		return ['url'=>url('admin/points')];
	}

	public function services()
	{
		$s = Service::orderBy('order','desc')->get();
		return view('services', compact('s'));
	}
	public function process()
	{
		$sections = Section::orderBy('order','desc')->get();
		return view('sections.process', compact('sections'));
	}

	public function indicators()
	{
		$sections = ReportSection::orderBy('order','desc')->get();
		return view('sections.indicators', compact('sections'));
	}

	public function addSection(Request $r)
	{
		$s = new Section;
		$s->name = $r->name;
		// $s->status = $r->status ? 1 : null;
		// $s->troublesome = $r->troublesome ? 1 : null;
		// $s->compliance = $r->compliance ? 1 : null;
		$s->save();

		return back();
	}

	public function getPoints($id)
	{
		$points = Point::where('customer_id',$id)->get();
		return $points;

	}

	public function savePointOffline(Request $r)
	{
		if ($r->point_id) {
			$p = Point::find($r->point_id);
		}else{
			$p = new Point;
		}
		
		$p->customer_id = $r->customer_id;

		$p->street = $r->street;
		$p->n_exterior = $r->n_exterior;
		$p->n_interior = $r->n_interior;
		$p->colony = $r->colony;
		$p->cp = $r->cp;
		$p->entity = $r->entity;
		$p->municipality = $r->municipality;
		$p->responsable = $r->responsable;

		if ($r->lat) {
			$p->lat = $r->lat;
		}
		if ($r->lng) {
			$p->lng = $r->lng;
		}

		$p->status = $r->status;
		$p->compliance = $r->compliance;

		$p->services = $r->services;
		$p->processes = $r->processes;

		$p->troublesome = $r->troublesome;

		$p->save();
	}

	public function saveSurvey(Request $r,$id)
	{
		$s = Survey::where('point_id',$id)->first();
		$p = Point::find($id);

		if ($r->hasFile('signature')) {
			$file = $r->file('signature');
            $path = public_path().'/uploads/points/signatures';
            $sign = uniqid().$file->getClientOriginalName();
            $file->move($path,$sign);

            $p->sign = $sign;
            $p->save();
		}

		if (!$s) {
			$s = new Survey;
			$s->point_id = $id;
		}

		$s->check_lists = $r->checklist;
		$s->electric_system_description = $r->electricdescription;
		$s->survey_validation = $r->validation;
		$s->equipment_inventory = $r->equipment;
		$s->visit_validation = $r->visit;
		$s->single_diagram = $r->diagram;
		$s->equipment_inventory_2 = $r->equipment_2;

		if ($r->hasFile('signaturet')) {
			$file = $r->file('signaturet');
            $path = public_path().'/uploads/points/signatures';
            $sign = uniqid().$file->getClientOriginalName();
            $file->move($path,$sign);

            $s->sign = $sign;
		}

		if ($r->hasFile('diagram_file')) {
			$file = $r->file('diagram_file');
            $path = public_path().'/uploads/points/diagrams';
            $diagram = uniqid().$file->getClientOriginalName();
            $file->move($path,$diagram);

            $s->diagram = $diagram;
		}
        
        $s->save();
	}

	public function migrar()
	{
		// Survey::truncate();
		// return Point::with('survey')->find(1);

		/*Schema::table('points', function(Blueprint $table) {
		    //
		    $table->string('aditional_file')->nullable();
		});*/

		/*Schema::table('points', function(Blueprint $table) {
		    //
		    $table->string('sign')->nullable();
		});*/

		/*Schema::table('points', function(Blueprint $table) {
		    //
		    $table->text('measuring')->nullable();

		});*/
		/*Schema::dropIfExists('point_images');
		Schema::create('point_images', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('point_id')->nullable();
		    $table->string('image')->nullable();
		    $table->string('key')->nullable();
		    $table->timestamps();
		    //
		});*/

		Schema::dropIfExists('surveys');
		Schema::create('surveys', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('point_id')->nullable();
		    $table->text('check_lists')->nullable();
		    $table->text('electric_system_description')->nullable();
		    $table->text('survey_validation')->nullable();
		    $table->text('equipment_inventory')->nullable();
		    $table->text('visit_validation')->nullable();
		    $table->text('single_diagram')->nullable();
		    $table->text('equipment_inventory_2')->nullable();
		    $table->text('test_report')->nullable();
		    $table->string('sign')->nullable();
		    $table->string('diagram')->nullable();
		    $table->timestamps();
		    //
		});

		return 'ok';

		Schema::table('users', function(Blueprint $table) {
		    //
		    $table->integer('status')->nullable();
		});
		return User::all();
		/*$services = [
			["label"=>"Capacidad de su transformador en KVA", "name"=>"kva", "type"=>"text", "options" => null, "only_admin" => 1],
			["label"=>"Registro Móvil de ususrio (RMU)", "name"=>"rmu", "type"=>"text", "options" => null, "only_admin" => null],
			["label"=>"No. Medidor", "name"=>"medidor", "type"=>"text", "options" => null, "only_admin" => null],
			["label"=>"Tensión de alimentación en kV", "name"=>"tension", "type"=>"text", "options" => null, "only_admin" => 1],
			["label"=>"Aéreo o subterráneo", "name"=>"type", "type"=>"select", "options" => ["Aéreo","Subterráneo"], "only_admin" => 1],
			["label"=>"Suministrador", "name"=>"suministrador", "type"=>"text", "options" => null, "only_admin" => null],
			["label"=>"División de Distribución CFE", "name"=>"cfe", "type"=>"text", "options" => null, "only_admin" => 1],
			["label"=>"Zona de distribución CFE", "name"=>"zona_cfe", "type"=>"text", "options" => null, "only_admin" => 1],
		];


		foreach ($services as $key => $r) {
			$s = new Service;
			$s->type = $r['type'];
			$s->category = null;
			$s->name = $r['name'];
			$s->label = $r['label'];
			$s->placeholder = $r['label'];
			$s->only_admin = $r['only_admin'] ? 1 : null;
			$s->save();

			if ($r['options']) {
				foreach ($r['options'] as $key => $value) {
					$so = new ServiceOption;
					$so->service_id = $s->id;
					$so->value = $value;
					$so->save();
				}
			}
		}*/

		// return User::all();

		// User::insert(["name" => "XAVIER ANGELES LARIOS", "email" => "xavierangeles@gmail.com","role_id"=>-1,"password"=>bcrypt("dZwYm4aqAfy8")]);
		// User::insert(["name" => "LORENZO ANTONIO AMADOR MOLINA", "email" => "antonioamadormolina@gmail.com","role_id"=>-1,"password"=>bcrypt("DDCNXqDHnPje")]);
		// User::insert(["name" => "RAUL SALMERON RAMIREZ", "email" => "rsalmeron07@hotmail.com","role_id"=>-1,"password"=>bcrypt("XvGWjxD4JgDj")]);
		// User::insert(["name" => "LUIS RAYMUNDO ANTONIO GUADALUPE","email" => "iluis.proyectos@gmail.com","role_id"=>-1,"password"=>bcrypt("jvEp1CEAOZZ3")]);
		// User::insert(["name" => "ROBERTO CARLOS CASTELLANOS SALAZAR", "email" => "castellanosrcs@gmail.com","role_id"=>-1,"password"=>bcrypt("VynUjI4rw5dn")]);
		// User::insert(["name" => "ABDIELH RAUL SANTANA LOPEZ", "email" => "abdielhsantanalopez@gmail.com","role_id"=>-1,"password"=>bcrypt("QojqUE8CA0c6")]);
		// User::insert(["name" => "ARMANDO PINEDA CRUZ", "email" => "arm_do01@hotmail.com","role_id"=>-1,"password"=>bcrypt("B5wlvbcxT4Fr")]);
		// User::insert(["name" => "ARMANDO CALDERON CORTEZ", "email" => "armandocalderoncortes@gmail.com","role_id"=>-1,"password"=>bcrypt("AteCKlFCl1t1")]);
		// User::insert(["name" => "JUAN CARLOS VAZQUEZ DURAN", "email" => "juancarlosvd1965@gmail.com","role_id"=>-1,"password"=>bcrypt("zbvE1PgQvki9")]);
		// User::insert(["name" => "DANIEL RODRIGUEZ ORDOÑEZ", "email" => "Danielrodord@outlook.com","role_id"=>-1,"password"=>bcrypt("vJGfFgjoAeXe")]);

		// User::truncate();
		// Customer::truncate();
		// Point::truncate();
		// ReportObservation::truncate();
		// ReportResult::truncate();

		// User::insert(["id"=>1,"name"=>"Admin","email"=>"admin@admin.com","role_id"=>-1,"password"=>bcrypt(123456)]);

		return false;
		// Point::truncate();
		/*$ents = [];
		$muns = [];
		$cps = [];
		$resp = [];
		foreach (Point::all() as $value)
		{
			$ents[] = $value->entity;
			$muns[] = $value->municipality;
			$cps[] = $value->cp;
			$resp[] = $value->responsable;
		}

		return [array_unique($ents),array_unique($muns),array_unique($cps),array_unique($resp)];*/
		// foreach (Customer::all() as $key => $value) {
		// 	$value->status = 1;
		// 	$value->save();
		// }
		Schema::dropIfExists('sections');
		Schema::dropIfExists('processes');

		Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('placeholder')->nullable();
            $table->integer('only_admin')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
		Schema::dropIfExists('process_options');
		Schema::create('process_options', function (Blueprint $table) {
            $table->id();
            $table->integer('process_id')->nullable();
            $table->string('value')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

		Schema::dropIfExists('report_sections');
		Schema::create('report_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('report_section_id')->nullable();
            $table->string('numeral')->nullable();
            $table->string('name')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
		Schema::dropIfExists('report_inputs');
        Schema::create('report_inputs', function (Blueprint $table) {
            $table->id();
            $table->integer('report_section_id')->nullable();
            $table->string('numeral')->nullable();
            $table->string('name')->nullable();
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->string('unity')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
		Schema::dropIfExists('report_observations');
		Schema::create('report_observations', function (Blueprint $table) {
            $table->id();
			$table->integer('report_input_id')->nullable();
            $table->integer('point_id')->nullable();
            $table->text('value')->nullable();
            $table->timestamps();
        });
		Schema::dropIfExists('report_results');
		Schema::create('report_results', function (Blueprint $table) {
            $table->id();
            $table->integer('report_input_id')->nullable();
            $table->integer('point_id')->nullable();
            $table->string('value')->nullable();
            $table->integer('compliance')->default(0);
            $table->timestamps();
        });

        Schema::table('sections', function(Blueprint $table) {
		    //
		    $table->integer('troublesome')->nullable();
		});
		Schema::table('sections', function(Blueprint $table) {
		    //
		    $table->integer('status')->nullable();
		    $table->integer('compliance')->nullable();
		});
		Schema::table('points', function(Blueprint $table) {
		    //
		    $table->integer('status')->nullable();
		    $table->integer('compliance')->nullable();
		});

		Schema::table('points', function(Blueprint $table) {
		    //
		    $table->text('troublesome')->nullable();
		});
	}
	public function generalMap()
	{
		$customers = Customer::with('points')->where('status',1)->get();

		return view('map', compact('customers'));
	}
	public function map($id)
	{
		$customer = Customer::find($id);

		return view('maps', compact('customer'));
	}
	public function import()
	{

	}
	public function export()
	{
		$ents = [];
		$muns = [];
		$cps = [];
		$resp = [];
		foreach (Point::all() as $value)
		{
			$ents[] = $value->entity;
			$muns[] = $value->municipality;
			$cps[] = $value->cp;
			$resp[] = $value->responsable;
		}
		return view('export', [
			'ents' => array_unique($ents),
			'muns' => array_unique($muns),
			'cps' => array_unique($cps),
			'resp' => array_unique($resp)
		]);
	}

	public function customersNew()
	{
		return view('new_customer');
	}

	public function customersEdit($id)
	{
		$cc = User::with('customer')->find($id);

		return view('edit_customer',compact('cc'));
	}

	public function customersAdd(Request $r)
	{
		$name = "";

		$this->validate($r,[
			'email' => 'required|unique:users'
		]);

		if ($r->hasFile('image')) {
			$file = $r->file('image');
            $path = public_path().'/uploads/customers';
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
		}

		$u = new User;
		$u->name = $r->name;
		$u->email = $r->email;
		$u->password = bcrypt($r->password);
		$u->role_id = 1;
		$u->save();

		$c = new Customer;
		$c->name = $r->name;
		$c->user_id = $u->id;
		$c->image = $name;
		$c->color = $r->color;
		$c->marker = $this->createSvg($r->color);
		$c->status = $r->status ? 1 : 0;
		$c->save();

		return redirect('admin/customers');
	}

	public function customersUpdate(Request $r,$id)
	{
		$name = "";

		$this->validate($r,[
			'email' => 'required|unique:users,id,'.$id
		]);

		if ($r->hasFile('image')) {
			$file = $r->file('image');
            $path = public_path().'/uploads/customers';
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
		}

		$u = User::find($id);
		$u->name = $r->name;
		$u->email = $r->email;
		if ($r->password) {
			$u->password = bcrypt($r->password);
		}
		$u->role_id = 1;
		$u->save();

		$c = Customer::where('user_id',$id)->first();
		$c->name = $r->name;
		$c->user_id = $u->id;
		if ($name) {
			$c->image = $name;
		}
		$c->color = $r->color;
		$c->marker = $this->createSvg($r->color);
		$c->status = $r->status ? 1 : 0;
		$c->save();

		return redirect('admin/customers');
	}
	public function pointsNew()
	{
		$customers = Customer::all();
		$services = Service::orderBy('order','desc')->get();
		$sections = Section::orderBy('order','desc')->get();
		return view('new_point',compact('customers','services','sections'));
	}

	public function createSvg($color = '#000000')
	{
		$data = '<?xml version="1.0"?>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
			<g xmlns="http://www.w3.org/2000/svg">
				<g>
					<path d="M256,0C153.755,0,70.573,83.182,70.573,185.426c0,126.888,165.939,313.167,173.004,321.035    c6.636,7.391,18.222,7.378,24.846,0c7.065-7.868,173.004-194.147,173.004-321.035C441.425,83.182,358.244,0,256,0z M256,278.719    c-51.442,0-93.292-41.851-93.292-93.293S204.559,92.134,256,92.134s93.291,41.851,93.291,93.293S307.441,278.719,256,278.719z" fill="'.$color.'" data-original="#000000" style="" class=""/>
				</g>
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			<g xmlns="http://www.w3.org/2000/svg">
			</g>
			</g></svg>
			';
		$name = uniqid().'.svg';

		$w = fopen(public_path('markers').'/'.$name, "w");
        fwrite($w, $data);
        fclose($w);

        return $name;
	}

	public function addTemplate($id = null)
    {
        return view('input',compact('id'));
    }

	public function addService(Request $r)
	{
		$s = new Service;
		$s->type = $r->type;
		$s->category = $r->category;
		$s->name = $r->name;
		$s->label = $r->label;
		$s->placeholder = $r->placeholder;
		$s->only_admin = $r->only_admin ? 1 : null;
		$s->save();

		if ($r->options) {
			foreach ($r->options as $key => $value) {
				$so = new ServiceOption;
				$so->service_id = $s->id;
				$so->value = $value;
				$so->save();
			}
		}
	}
	public function addProcess(Request $r)
	{
		$s = new Process;
		$s->type = $r->type;
		$s->section_id = $r->section_id;
		$s->name = $r->name;
		$s->label = $r->label;
		$s->placeholder = $r->placeholder;
		$s->only_admin = $r->only_admin ? 1 : null;
		$s->save();

		if ($r->options) {
			foreach ($r->options as $key => $value) {
				$so = new ProcessOption;
				$so->process_id = $s->id;
				$so->value = $value;
				$so->save();
			}
		}
	}
	public function updateService(Request $r)
	{
        $s = Service::find($r->id);
        if (isset($r->modify)) {
            $s->type = $r->type;
        }
        $s->category = $r->category;
		$s->name = $r->name;
		$s->label = $r->label;
		$s->placeholder = $r->placeholder;
		$s->only_admin = $r->only_admin ? 1 : null;
        
        $s->save();

        if (isset($r->modify)) {

            ServiceOption::where('service_id',$r->id)->delete();

            if ($r->options) {
				foreach ($r->options as $key => $value) {
					$so = new ServiceOption;
					$so->service_id = $s->id;
					$so->value = $value;
					$so->save();
				}
			}
        }
	}

	public function updateProcess(Request $r)
	{
        $s = Process::find($r->id);
        if (isset($r->modify)) {
            $s->type = $r->type;
        }
		$s->name = $r->name;
		$s->label = $r->label;
		$s->placeholder = $r->placeholder;
		$s->only_admin = $r->only_admin ? 1 : null;
        
        $s->save();

        if (isset($r->modify)) {

            ProcessOption::where('process_id',$r->id)->delete();

            if ($r->options) {
				foreach ($r->options as $key => $value) {
					$so = new ProcessOption;
					$so->process_id = $s->id;
					$so->value = $value;
					$so->save();
				}
			}
        }
	}

	public function changeServiceOrder(Request $r)
	{
		if ($r->inputs) {
            $a = count($r->inputs);
            foreach ($r->inputs as $key => $value) {
                $inp = Service::find($value);
                $inp->order = $a;
                $inp->save();
                $a--;
            }
        }
	}
	public function changeProcessOrder(Request $r)
	{
		if ($r->inputs) {
            $a = count($r->inputs);
            foreach ($r->inputs as $key => $value) {
                $inp = Process::find($value);
                $inp->order = $a;
                $inp->save();
                $a--;
            }
        }
	}
	public function changeSectionOrder(Request $r)
	{
		if ($r->sections) {
            $a = count($r->sections);
            foreach ($r->sections as $key => $value) {
                $inp = Section::find($value);
                $inp->order = $a;
                $inp->save();
                $a--;
            }
        }
	}

	public function saveLatLng(Request $r)
	{
		if ($r->points) {
			foreach ($r->points as $np)
			{
				$p = Point::find($np['id']);
				$p->lat = $np['lat'];
				$p->lng = $np['lng'];
				$p->save();
			}
		}
	}

	public function deleteService($id)
	{
		Service::find($id)->delete();
	}
	public function deleteQuestion($id)
	{
		Process::find($id)->delete();
	}
	public function deleteSection($id)
	{
		Section::find($id)->delete();
	}




	/**/


	public function addReportTemplate($id = null)
    {
        return view('report-input',compact('id'));
    }

    public function addReportSection(Request $r)
	{
		$s = new ReportSection;
		$s->numeral = $r->numeral;
		$s->name = $r->name;
		$s->save();

		return back();
	}

	public function updateSection(Request $r)
	{
		$s = ReportSection::find($r->id);
		$s->numeral = $r->numeral;
		$s->name = $r->name;
		$s->save();

		return back();
	}

	public function addReportSubSection(Request $r)
	{
		$s = new ReportSection;
		$s->report_section_id = $r->report_section_id;
		$s->numeral = $r->numeral;
		$s->name = $r->name;
		$s->save();

		return back();
	}

    public function addReportInput(Request $r)
	{
		$s = new ReportInput;
		$s->report_section_id = $r->report_section_id;
		$s->numeral = $r->numeral;
		$s->name = $r->name;
		$s->min = $r->min;
		$s->max = $r->max;
		$s->unity = $r->unity;
		$s->save();
	}

	public function updateReportInput(Request $r,$id)
	{
		$s = ReportInput::find($id);
		// $s->report_section_id = $r->report_section_id;
		$s->numeral = $r->numeral;
		$s->name = $r->name;
		$s->min = $r->min;
		$s->max = $r->max;
		$s->unity = $r->unity;
		$s->save();
	}

	public function deleteReportSection($id)
	{
		ReportSection::find($id)->delete();
	}

	public function savePointReport(Request $r)
	{
		if ($r->results) {
			
			ReportResult::where(['point_id' => $r['point_id']])->delete();

			foreach ($r->results as $res) {
				$r_r = new ReportResult;
				$r_r->report_input_id = $res['id'];
				$r_r->point_id = $res['point_id'];
				$r_r->value = $res['value'];
				$r_r->compliance = isset($res['compliance']) ? $res['compliance'] : 1;
				$r_r->save();
			}
		}

		if ($r->observations) {
			foreach ($r->observations as $obs) {

				$r_o = ReportObservation::where(['report_input_id' => $obs['id'],'point_id' => $obs['point_id']])->first();

				if (!$r_o) {
					$r_o = new ReportObservation;
					$r_o->report_input_id = $obs['id'];
					$r_o->point_id = $obs['point_id'];

				}
				$r_o->value = $obs['value'];
				$r_o->save();
			}
		}
	
	}

	public function getNullLatLng()
	{
		return Point::where('lat',null)->get();
	}

	public function pointsDelete($id)
	{
		Point::find($id)->delete();

		return back();
	}

	/**/

	public function technicians()
	{
		$tech = User::where('role_id',0)->get();

		return view('technicians', compact('tech'));
	}

	public function techniciansAdd(Request $r)
	{
		$name = "";

		$this->validate($r,[
			'email' => 'required|unique:users'
		]);

		$u = new User;
		$u->name = $r->name;
		$u->email = $r->email;
		$u->password = bcrypt($r->password);
		$u->role_id = 0; // tecnico
		$u->status = 1;
		$u->save();

		return redirect('admin/technicians');
	}

	public function techniciansUpdate(Request $r,$id)
	{
		$name = "";

		$this->validate($r,[
			'email' => 'required|unique:users'
		]);

		$u = User::find($id);
		$u->name = $r->name;
		$u->email = $r->email;
		if ($r->password) {
			$u->password = bcrypt($r->password);
		}
		$u->role_id = 0; // tecnico
		$u->status = $r->status ? 1 : 0;
		$u->save();

		return redirect('admin/technicians');
	}

	public function techniciansEdit($id)
	{
		$tech = User::find($id);

		return view('edit_technician',compact('tech'));
	}

	public function techniciansNew()
	{
		return view('new_technician');
	}

	/**/

	public function selectCustomer(Request $r)
	{
		$cus = Customer::find($r->id);

		session(['customer' => $cus]);

		return back();
	}

	public function pointsGathering($id)
	{
		$p = Point::find($id);
		return view('gathering', compact('p'));
	}

}

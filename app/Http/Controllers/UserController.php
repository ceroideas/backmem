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
use Auth;

class UserController extends Controller
{
    //
    public function login(Request $r)
    {
    	if (Auth::attempt(['email' => $r->email, 'password' => $r->password],$r->remember)) {
    		return redirect('/admin');
    	}
    	return back()->withErrors('Usuario no encontrado');
    }

    public function getServices()
    {
        $customers = Customer::all();
        $services = Service::orderBy('order','desc')->with('options')->get();
        $sections = Section::orderBy('order','desc')->with('inputs.options')->get();

        return compact('customers','services','sections');
    }

    public function uploadInformation(Request $r)
    {
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
        $p->lat = $r->lat;
        $p->lng = $r->lng;

        $p->status = $r->status;
        $p->compliance = $r->compliance;

        $p->services = $r->services;
        $p->processes = $r->processes;

        $p->troublesome = $r->troublesome;

        $p->save();
    }

    public function uploadInformations(Request $r)
    {
        if ($r->points) {
            foreach ($r->points as $key => $point) {
                
                $p = new Point;
            
                $p->customer_id = $point['customer_id'];

                $p->street = $point['street'];
                $p->n_exterior = $point['n_exterior'];
                $p->n_interior = $point['n_interior'];
                $p->colony = $point['colony'];
                $p->cp = $point['cp'];
                $p->entity = $point['entity'];
                $p->municipality = $point['municipality'];
                $p->responsable = $point['responsable'];
                $p->lat = $point['lat'];
                $p->lng = $point['lng'];

                $p->status = $point['status'];
                $p->compliance = $point['compliance'];

                $p->services = $point['services'];
                $p->processes = $point['processes'];

                $p->troublesome = $point['troublesome'];

                $p->save();

            }
        }
    }
}

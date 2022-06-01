<?php

namespace App\Imports;

use App\Models\Point;
use App\Models\Service;
use App\Models\Process;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ReportImport implements ToCollection
{
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function collection(Collection $rows)
    {
        try {

            $first_row = json_decode(json_encode($rows[1]), true);

            $array = [];

            foreach ($rows as $key => $row)
            {
                if ($key > 1) {
                   
                    $actual_row = json_decode(json_encode($row), true);
                    $aux = [];
                    $services = [];
                    $process = [];

                    foreach ($actual_row as $key1 => $value)
                    {
                        $ss = [];
                        $pp = [];

                        if (strstr($first_row[$key1],'service')) {
                            
                            $name = str_replace('service.', '', $first_row[$key1]);

                            $t = Service::where('name',$name)->first();

                            $ss = ['key' => $name, 'title' => $t ? $t->label : 'N/A', 'value' => $value];
                            $services[] = $ss;

                        }elseif(strstr($first_row[$key1],'process')) {
                            
                            $name = str_replace('process.', '', $first_row[$key1]);

                            $t = Process::where('name',$name)->first();

                            $pp = ['key' => $name, 'title' => $t ? $t->label : 'N/A', 'value' => $value];
                            $process[] = $pp;

                        }else {

                            $aux[$first_row[$key1]] = $value;
                        }
                    }

                    $aux['services'] = json_encode($services);
                    $aux['processes'] = json_encode($process);

                    $array[] = $aux;

                }
            }

            foreach ($array as $key => $value) {

                if ($value['street'] != "" && $value['n_exterior'] != "" && $value['n_interior'] != "") {
                    $p = Point::where(['street' => $value['street'],'n_exterior' => $value['n_exterior'],'entity' => $value['entity'],'municipality' => $value['municipality']])->first();

                    if (!$p) {
                        $p = new Point;
                    }
                    
                    $p->customer_id = $this->id;

                    $p->street = $value['street'];
                    $p->n_exterior = $value['n_exterior'];
                    $p->n_interior = $value['n_interior'];
                    $p->colony = $value['colony'];
                    $p->cp = $value['cp'];
                    $p->entity = $value['entity'];
                    $p->municipality = $value['municipality'];
                    $p->responsable = $value['responsable'];
                    // $p->image = "";
                    // $p->lat = $value['lat'];
                    // $p->lng = $value['lng'];

                    // $p->status = $value['status'];
                    // $p->compliance = $value['compliance'];

                    $p->services = $value['services'];
                    $p->processes = $value['processes'];

                    // $p->troublesome = $value['troublesome'];

                    $p->save();
                }
            }

        } catch (Exception $e) {
            
            return abort(500);
        }
    }
}
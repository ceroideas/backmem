<?php

namespace App\Exports;

use App\Models\Point;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
	public function __construct($param1, $param2)
	{
		$this->param1 = $param1;
		$this->param2 = $param2;
	}

    public function view(): View
    {
    	$points = Point::where($this->param1,$this->param2)->with('customer')->get();

        return view('exports.test', compact('points'));
    }
}
<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SamplePage implements FromView, WithTitle, ShouldAutoSize, WithStyles
{
	public function __construct($page)
	{
		$this->page = $page;
	}
    public function view(): View
    {
    	if ($this->page == 1) {
        	return view('exports.explanation');
    	}else{
        	return view('exports.sample');
    	}
    }

    public function title(): string
    {
    	if ($this->page == 1) {
        	return '1. Instrucciones';
    	}else{
        	return '2. Datos';
    	}
    }

    public function styles(Worksheet $sheet)
    {
        if ($this->page == 1) {
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000'],
                    ],
                ],
            ];
            // $styleArrayT = [
            //     'borders' => [
            //         'outline' => [
            //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            //             'color' => ['argb' => '000'],
            //         ],
            //     ],
            // ];

            $sheet->getStyle('B4:B10')->applyFromArray($styleArray);
            $sheet->getStyle('B4')->applyFromArray($styleArray);
            $sheet->getStyle('B6')->applyFromArray($styleArray);
            $sheet->getStyle('B8')->applyFromArray($styleArray);
            $sheet->getStyle('B10')->applyFromArray($styleArray);

            $sheet->getStyle('B1')->getFont()->setSize(18);
        }
    }
}
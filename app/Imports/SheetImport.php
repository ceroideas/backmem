<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class SheetImport implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function conditionalSheets(): array
    {
        return [1 => new ReportImport($this->id)];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        session(["error_sheet" => "El archivo subido no tenia el formato requerido, vuelva a intentarlo"]);
        info("Sheet {$sheetName} was skipped");
    }
}
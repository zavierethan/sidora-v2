<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Exports\Sheets\OlahragaPrestasiSheet;

class OlahragaPrestasiExport implements WithMultipleSheets
{
    protected $olahragaPrestasi;

    public function __construct($olahragaPrestasi)
    {
        $this->olahragaPrestasi = $olahragaPrestasi;
    }

    public function sheets(): array
    {
        return [
            new OlahragaPrestasiSheet($this->olahragaPrestasi),
        ];
    }
}

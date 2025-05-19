<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Exports\Sheets\OlahragaMasyarakatSheet;

class OlahragaMasyarakatExport implements WithMultipleSheets
{
    protected $olahragaMasyarakat;

    public function __construct($olahragaMasyarakat)
    {
        $this->olahragaMasyarakat = $olahragaMasyarakat;
    }

    public function sheets(): array
    {
        return [
            new OlahragaMasyarakatSheet($this->olahragaMasyarakat),
        ];
    }
}

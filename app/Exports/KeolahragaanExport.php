<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Exports\Sheets\InformasiWilayahSheet;
use App\Exports\Sheets\SaranaSheet;
use App\Exports\Sheets\PrasaranaSheet;
use App\Exports\Sheets\KegiatanOlahragaSheet;

class KeolahragaanExport implements WithMultipleSheets
{
    protected $informasiWilayah;
    protected $sarana;
    protected $prasarana;
    protected $kegiatanOlahraga;

    public function __construct($informasiWilayah, $sarana, $prasarana, $kegiatanOlahraga)
    {
        $this->informasiWilayah = $informasiWilayah;
        $this->sarana = $sarana;
        $this->prasarana = $prasarana;
        $this->kegiatanOlahraga = $kegiatanOlahraga;
    }

    public function sheets(): array
    {
        return [
            new InformasiWilayahSheet($this->informasiWilayah),
            new SaranaSheet($this->sarana),
            new PrasaranaSheet($this->prasarana),
            new KegiatanOlahragaSheet($this->kegiatanOlahraga),
        ];
    }
}

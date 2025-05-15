<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

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
        $worksheet = new Worksheet();
        
        return [
            'Data' => new KeolahragaanExport($this->informasiWilayah, $worksheet),
            'Sarana' => new KeolahragaanExport($this->sarana, $worksheet),
            'Prasarana' => new KeolahragaanExport($this->prasrana, $worksheet),
            'KegiatanOlahraga' => new KeolahragaanExport($this->kegiatanOlahraga, $worksheet),
        ];
    }
}

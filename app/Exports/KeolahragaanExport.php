<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Exports\Sheets\InformasiWilayahSheet;
use App\Exports\Sheets\SaranaSheet;
use App\Exports\Sheets\PrasaranaSheet;
use App\Exports\Sheets\KegiatanOlahragaSheet;
use App\Exports\Sheets\OlahragaPrestasiSheet;

class KeolahragaanExport implements WithMultipleSheets
{
    protected $informasiWilayah;
    protected $sarana;
    protected $prasarana;
    protected $kegiatanOlahraga;
    protected $olahragaPrestasi;

    public function __construct($informasiWilayah, $sarana, $prasarana, $kegiatanOlahraga, $olahragaPrestasi)
    {
        $this->informasiWilayah = $informasiWilayah;
        $this->sarana = $sarana;
        $this->prasarana = $prasarana;
        $this->kegiatanOlahraga = $kegiatanOlahraga;
        $this->olahragaPrestasi = $olahragaPrestasi;
    }

    public function sheets(): array
    {
        return [
            new InformasiWilayahSheet($this->informasiWilayah),
            new SaranaSheet($this->sarana),
            new PrasaranaSheet($this->prasarana),
            new KegiatanOlahragaSheet($this->kegiatanOlahraga),
            new OlahragaPrestasiSheet($this->olahragaPrestasi),
        ];
    }
}

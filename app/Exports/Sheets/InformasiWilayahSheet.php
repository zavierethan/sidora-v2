<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InformasiWilayahSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Nama Kecamatan',
            'Nama Desa / Kelurahan',
            'Jumlah Infrastruktur',
            'Jumlah Event Olahraga',
        ];
    }

    public function title(): string
    {
        return 'Informasi Wilayah';
    }
}

<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaranaSheet implements FromCollection, WithTitle, WithHeadings
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
            'Nama Sarana',
            'Tipe Sarana',
            'Satus Kepemilikan',
            'Nama Pemilik',
            'Ukuran',
            'Status Kondisi',
            'Latitude',
            'Longitude',
            'Alamat',
        ];
    }

    public function title(): string
    {
        return 'Sarana';
    }
}

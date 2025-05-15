<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KegiatanOlahragaSheet implements FromCollection, WithTitle, WithHeadings
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
            'Cabang Olahraga',
            'Nama Kelompok (Klub)',
            'Nama Ketua Klub',
            'Jumlah Anggota',
            'Terverifikasi',
            'Nomor SK',
            'Alamat Sekretariat'
        ];
    }

    public function title(): string
    {
        return 'Kegiatan Olahraga';
    }
}

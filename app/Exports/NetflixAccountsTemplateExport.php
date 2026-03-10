<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NetflixAccountsTemplateExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return new Collection([
            [
                'contoh@gmail.com',
                'password123',
                '2026-03-10',
                '1P1U 1 Bulan',
                'catatan opsional',
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'email',
            'password',
            'tanggal_reset',
            'tipe_sharing',
            'deskripsi',
        ];
    }
}
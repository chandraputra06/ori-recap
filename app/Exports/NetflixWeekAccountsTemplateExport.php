<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NetflixWeekAccountsTemplateExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return new Collection([
            [
                'contoh@gmail.com',
                'password123',
                '2026-03-08',
                '2026-03-15',
                'catatan opsional',
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'email',
            'password',
            'tanggal_terjual',
            'durasi_habis',
            'deskripsi',
        ];
    }
}
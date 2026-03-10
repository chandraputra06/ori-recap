<?php

namespace App\Exports;

use App\Models\NetflixWeekAccount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NetflixWeekAccountsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return NetflixWeekAccount::query()
            ->orderBy('id', 'asc')
            ->get([
                'email',
                'password',
                'tanggal_terjual',
                'durasi_habis',
                'deskripsi',
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
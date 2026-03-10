<?php

namespace App\Exports;

use App\Models\NetflixAccount;
use App\Models\NetflixAccounts;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NetflixAccountsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return NetflixAccounts::query()
            ->orderBy('id', 'asc')
            ->get([
                'email',
                'password',
                'tanggal_reset',
                'tipe_sharing',
                'deskripsi',
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NetflixAccounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'tanggal_reset',
        'tipe_sharing',
        'deskripsi',
    ];

    public function getStatusResetAttribute(): array
    {
        if (!$this->tanggal_reset) {
            return [
                'label' => 'Belum Diatur',
                'class' => 'bg-gray-100 text-gray-700',
            ];
        }

        $today = Carbon::today();
        $resetDate = Carbon::parse($this->tanggal_reset);
        $diff = $today->diffInDays($resetDate, false);

        if ($diff < 0) {
            return [
                'label' => 'Lewat Reset',
                'class' => 'bg-red-100 text-red-700',
            ];
        }

        if ($diff === 0) {
            return [
                'label' => 'Reset Hari Ini',
                'class' => 'bg-orange-100 text-orange-700',
            ];
        }

        if ($diff >= 1 && $diff <= 3) {
            return [
                'label' => 'Segera Reset',
                'class' => 'bg-yellow-100 text-yellow-700',
            ];
        }

        return [
            'label' => 'Aman',
            'class' => 'bg-green-100 text-green-700',
        ];
    }
}
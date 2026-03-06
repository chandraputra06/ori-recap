<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetflixWeekAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'tanggal_terjual',
        'durasi_habis',
        'deskripsi',
    ];

    public function getStatusHabisAttribute(): array
    {
        if (!$this->durasi_habis) {
            return [
                'label' => 'Belum Diatur',
                'class' => 'bg-gray-100 text-gray-700',
            ];
        }

        $today = Carbon::today();
        $expiredDate = Carbon::parse($this->durasi_habis);
        $diff = $today->diffInDays($expiredDate, false);

        if ($diff < 0) {
            return [
                'label' => 'Sudah Habis',
                'class' => 'bg-red-100 text-red-700',
            ];
        }

        if ($diff === 0) {
            return [
                'label' => 'Habis Hari Ini',
                'class' => 'bg-orange-100 text-orange-700',
            ];
        }

        if ($diff >= 1 && $diff <= 2) {
            return [
                'label' => 'Segera Habis',
                'class' => 'bg-yellow-100 text-yellow-700',
            ];
        }

        return [
            'label' => 'Aktif',
            'class' => 'bg-green-100 text-green-700',
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\NetflixAccount;
use App\Models\NetflixAccounts;
use App\Models\NetflixWeekAccount;

class ReminderController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $resetHariIni = NetflixAccounts::whereDate('tanggal_reset', $today)
            ->orderBy('tanggal_reset', 'asc')
            ->get();

        $segeraReset = NetflixAccounts::whereBetween('tanggal_reset', [
            now()->addDay()->toDateString(),
            now()->addDays(3)->toDateString(),
        ])
            ->orderBy('tanggal_reset', 'asc')
            ->get();

        $lewatReset = NetflixAccounts::whereDate('tanggal_reset', '<', $today)
            ->orderBy('tanggal_reset', 'asc')
            ->get();

        $habisHariIni = NetflixWeekAccount::whereDate('durasi_habis', $today)
            ->orderBy('durasi_habis', 'asc')
            ->get();

        $segeraHabis = NetflixWeekAccount::whereBetween('durasi_habis', [
            now()->addDay()->toDateString(),
            now()->addDays(2)->toDateString(),
        ])
            ->orderBy('durasi_habis', 'asc')
            ->get();

        $sudahHabis = NetflixWeekAccount::whereDate('durasi_habis', '<', $today)
            ->orderBy('durasi_habis', 'asc')
            ->get();

        return view('admin-page.reminders.index', compact(
            'resetHariIni',
            'segeraReset',
            'lewatReset',
            'habisHariIni',
            'segeraHabis',
            'sudahHabis'
        ));
    }
}
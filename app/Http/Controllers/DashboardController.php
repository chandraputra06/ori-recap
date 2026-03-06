<?php

namespace App\Http\Controllers;

use App\Models\NetflixAccount;
use App\Models\NetflixAccounts;
use App\Models\NetflixWeekAccount;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $threeDaysLater = now()->addDays(3)->toDateString();
        $twoDaysLater = now()->addDays(2)->toDateString();

        $totalNetflixAccounts = NetflixAccounts::count();
        $totalNetflixWeekAccounts = NetflixWeekAccount::count();

        $resetHariIni = NetflixAccounts::whereDate('tanggal_reset', $today)->count();

        $segeraReset = NetflixAccounts::whereBetween('tanggal_reset', [
            now()->addDay()->toDateString(),
            $threeDaysLater,
        ])->count();

        $lewatReset = NetflixAccounts::whereDate('tanggal_reset', '<', $today)->count();

        $habisHariIni = NetflixWeekAccount::whereDate('durasi_habis', $today)->count();

        $segeraHabis = NetflixWeekAccount::whereBetween('durasi_habis', [
            now()->addDay()->toDateString(),
            $twoDaysLater,
        ])->count();

        $sudahHabis = NetflixWeekAccount::whereDate('durasi_habis', '<', $today)->count();

        $resetTerdekat = NetflixAccounts::whereNotNull('tanggal_reset')
            ->orderBy('tanggal_reset', 'asc')
            ->take(5)
            ->get();

        $habisTerdekat = NetflixWeekAccount::whereNotNull('durasi_habis')
            ->orderBy('durasi_habis', 'asc')
            ->take(5)
            ->get();

        return view('admin-page.dashboard.index', compact(
            'totalNetflixAccounts',
            'totalNetflixWeekAccounts',
            'resetHariIni',
            'segeraReset',
            'lewatReset',
            'habisHariIni',
            'segeraHabis',
            'sudahHabis',
            'resetTerdekat',
            'habisTerdekat'
        ));
    }
}
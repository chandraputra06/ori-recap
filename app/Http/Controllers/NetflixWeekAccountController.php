<?php

namespace App\Http\Controllers;

use App\Exports\NetflixWeekAccountsExport;
use App\Exports\NetflixWeekAccountsTemplateExport;
use App\Http\Requests\StoreNetflixWeekAccountRequest;
use App\Http\Requests\UpdateNetflixWeekAccountRequest;
use App\Imports\NetflixWeekAccountsImport;
use App\Models\NetflixWeekAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NetflixWeekAccountController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $sort = $request->query('sort');
        $status = $request->query('status');

        $netflixWeekAccounts = NetflixWeekAccount::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($subQuery) use ($q) {
                    $subQuery
                        ->where('id', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('password', 'like', "%{$q}%")
                        ->orWhere('deskripsi', 'like', "%{$q}%");
                });
            })
            ->when($status === 'belum_diatur', function ($query) {
                $query->whereNull('durasi_habis');
            })
            ->when($status === 'aktif', function ($query) {
                $query->whereDate('durasi_habis', '>', now()->addDays(2)->toDateString());
            })
            ->when($status === 'segera_habis', function ($query) {
                $query->whereBetween('durasi_habis', [now()->addDay()->toDateString(), now()->addDays(2)->toDateString()]);
            })
            ->when($status === 'habis_hari_ini', function ($query) {
                $query->whereDate('durasi_habis', now()->toDateString());
            })
            ->when($status === 'sudah_habis', function ($query) {
                $query->whereDate('durasi_habis', '<', now()->toDateString());
            })
            ->when($sort === 'oldest', function ($query) {
                $query->orderBy('id', 'asc');
            })
            ->when($sort === 'latest', function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->when($sort === 'expired_asc', function ($query) {
                $query->orderByRaw('durasi_habis IS NULL, durasi_habis ASC');
            })
            ->when($sort === 'expired_desc', function ($query) {
                $query->orderByRaw('durasi_habis IS NULL, durasi_habis DESC');
            })
            ->when(!$sort, function ($query) {
                $query->orderBy('id', 'asc');
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin-page.netflix-week-accounts.index', [
            'netflixWeekAccounts' => $netflixWeekAccounts,
            'q' => $q,
            'sort' => $sort,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('admin-page.netflix-week-accounts.create');
    }

    public function store(StoreNetflixWeekAccountRequest $request)
    {
        DB::beginTransaction();

        try {
            NetflixWeekAccount::create($request->validated());

            DB::commit();

            return redirect()->route('admin.netflix-week-accounts.index')->with('success', 'Data Netflix 1 Week berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('admin.netflix-week-accounts.create')
                ->with('error', 'Gagal menambahkan data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit(NetflixWeekAccount $netflixWeekAccount)
    {
        return view('admin-page.netflix-week-accounts.edit', compact('netflixWeekAccount'));
    }

    public function update(UpdateNetflixWeekAccountRequest $request, NetflixWeekAccount $netflixWeekAccount)
    {
        DB::beginTransaction();

        try {
            $netflixWeekAccount->update($request->validated());

            DB::commit();

            return redirect()->route('admin.netflix-week-accounts.index')->with('success', 'Data Netflix 1 Week berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('admin.netflix-week-accounts.edit', $netflixWeekAccount->id)
                ->with('error', 'Gagal memperbarui data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function destroy(NetflixWeekAccount $netflixWeekAccount)
    {
        DB::beginTransaction();

        try {
            $netflixWeekAccount->delete();

            DB::commit();

            return redirect()->route('admin.netflix-week-accounts.index')->with('success', 'Data Netflix 1 Week berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('admin.netflix-week-accounts.index')
                ->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new NetflixWeekAccountsExport(), 'netflix-1-week.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xlsx,xls,csv'],
        ]);

        Excel::import(new NetflixWeekAccountsImport(), $request->file('file'));

        return redirect()->route('admin.netflix-week-accounts.index')->with('success', 'Data Netflix 1 Week berhasil diimport.');
    }

    public function downloadTemplate()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new NetflixWeekAccountsTemplateExport(), 'template-import-netflix-1-week.xlsx');
    }
}

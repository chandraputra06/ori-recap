<?php

namespace App\Http\Controllers;

use App\Exports\NetflixAccountsExport;
use App\Exports\NetflixAccountsTemplateExport;
use App\Http\Requests\StoreNetflixAccountRequest;
use App\Http\Requests\UpdateNetflixAccountRequest;
use App\Imports\NetflixAccountsImport;
use App\Models\NetflixAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NetflixAccountsController extends Controller
{
    private array $sharingOptions = ['1P1U 1 Bulan', '1P2U 1 Bulan', '1P1U 1 Week', 'DIBELI'];

    public function index(Request $request)
    {
        $q = $request->query('q');
        $sort = $request->query('sort');
        $status = $request->query('status');

        $netflixAccounts = NetflixAccounts::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($subQuery) use ($q) {
                    $subQuery
                        ->where('id', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('password', 'like', "%{$q}%")
                        ->orWhere('tipe_sharing', 'like', "%{$q}%")
                        ->orWhere('deskripsi', 'like', "%{$q}%");
                });
            })
            ->when($status === 'belum_diatur', function ($query) {
                $query->whereNull('tanggal_reset');
            })
            ->when($status === 'aman', function ($query) {
                $query->whereDate('tanggal_reset', '>', now()->addDays(3)->toDateString());
            })
            ->when($status === 'segera_reset', function ($query) {
                $query->whereBetween('tanggal_reset', [now()->addDay()->toDateString(), now()->addDays(3)->toDateString()]);
            })
            ->when($status === 'reset_hari_ini', function ($query) {
                $query->whereDate('tanggal_reset', now()->toDateString());
            })
            ->when($status === 'lewat_reset', function ($query) {
                $query->whereDate('tanggal_reset', '<', now()->toDateString());
            })
            ->when($sort === 'oldest', function ($query) {
                $query->orderBy('id', 'asc');
            })
            ->when($sort === 'latest', function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->when($sort === 'reset_asc', function ($query) {
                $query->orderByRaw('tanggal_reset IS NULL, tanggal_reset ASC');
            })
            ->when($sort === 'reset_desc', function ($query) {
                $query->orderByRaw('tanggal_reset IS NULL, tanggal_reset DESC');
            })
            ->when(!$sort, function ($query) {
                $query->orderBy('id', 'asc');
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin-page.netflix-accounts.index', [
            'netflixAccounts' => $netflixAccounts,
            'q' => $q,
            'sort' => $sort,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('admin-page.netflix-accounts.create', [
            'sharingOptions' => $this->sharingOptions,
        ]);
    }

    public function store(StoreNetflixAccountRequest $request)
    {
        DB::beginTransaction();

        try {
            NetflixAccounts::create($request->validated());

            DB::commit();

            return redirect()->route('admin.netflix-accounts.index')->with('success', 'Data rekapan Netflix berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('admin.netflix-accounts.create')
                ->with('error', 'Gagal menambahkan data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit(NetflixAccounts $netflixAccount)
    {
        return view('admin-page.netflix-accounts.edit', [
            'netflixAccount' => $netflixAccount,
            'sharingOptions' => $this->sharingOptions,
        ]);
    }

    public function update(UpdateNetflixAccountRequest $request, NetflixAccounts $netflixAccount)
    {
        DB::beginTransaction();

        try {
            $netflixAccount->update($request->validated());

            DB::commit();

            return redirect()->route('admin.netflix-accounts.index')->with('success', 'Data rekapan Netflix berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('admin.netflix-accounts.edit', $netflixAccount->id)
                ->with('error', 'Gagal memperbarui data: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function destroy(NetflixAccounts $netflixAccount)
    {
        DB::beginTransaction();

        try {
            $netflixAccount->delete();

            DB::commit();

            return redirect()->route('admin.netflix-accounts.index')->with('success', 'Data rekapan Netflix berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('admin.netflix-accounts.index')
                ->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new NetflixAccountsExport(), 'rekapan-netflix.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(
            [
                'file' => ['required', 'mimes:xlsx,xls,csv'],
            ],
            [
                'file.required' => 'File import wajib dipilih terlebih dahulu.',
                'file.mimes' => 'File harus berupa format Excel atau CSV: xlsx, xls, atau csv.',
            ],
        );

        try {
            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\NetflixAccountsImport(), $request->file('file'));

            return redirect()->route('admin.netflix-accounts.index')->with('success', 'Data Rekapan Netflix berhasil diimport.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.netflix-accounts.index')->with('error', 'Import gagal. Pastikan format file sesuai template.');
        }
    }

    public function downloadTemplate()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new NetflixAccountsTemplateExport(), 'template-import-rekapan-netflix.xlsx');
    }
}

<?php

namespace App\Imports;

use App\Models\NetflixWeekAccount;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NetflixWeekAccountsImport implements ToCollection, WithHeadingRow
{
    public int $imported = 0;
    public int $skipped = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $email = $this->cleanValue($row['email'] ?? null);
            $password = $this->cleanValue($row['password'] ?? null);

            if (!$email) {
                $this->skipped++;
                continue;
            }

            NetflixWeekAccount::create([
                'email' => $email,
                'password' => $password ?? '-',
                'tanggal_terjual' => $this->transformDate($row['tanggal_terjual'] ?? null),
                'durasi_habis' => $this->transformDate($row['durasi_habis'] ?? null),
                'deskripsi' => $this->cleanValue($row['deskripsi'] ?? null),
            ]);

            $this->imported++;
        }
    }

    private function cleanValue($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value !== '' ? $value : null;
    }

    private function transformDate($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        try {
            if (is_numeric($value)) {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
            }

            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable $th) {
            return null;
        }
    }
}
<?php

namespace App\Imports;

use App\Models\Department;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartmentsImport implements ToCollection, WithHeadingRow
{
    public $skippedCodes = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $code = strtoupper(trim($row['code'] ?? ''));
            $name = trim($row['name'] ?? '');
            $address = trim($row['address'] ?? '');
            $check = Department::where('code', $code)->exists();
            if ($check) {
                $this->skippedCodes[] = $code; // lưu mã trùng
                continue;
            } else {
                Department::create([
                    'code' => $code,
                    'name' => $name,
                    'address' => $address,
                ]);
            }
        }
    }
}

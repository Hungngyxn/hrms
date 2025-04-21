<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Employee([
            'name' => $row['name'],
            'position_id' => Position::firstOrCreate(['name' => $row['position']])->id,
            'department_id' => Department::firstOrCreate(['name' => $row['department']])->id,
            'start_of_contract' => $row['start_of_contract'],
            'end_of_contract' => $row['end_of_contract'],
        ]);
    }
}


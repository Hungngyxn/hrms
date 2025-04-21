<?php
namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::with('position', 'department')->get()->map(function ($employee) {
            return [
                'Name' => $employee->name,
                'Position' => $employee->position->name,
                'Department' => $employee->department->name,
                'Start of Contract' => $employee->start_of_contract,
                'End of Contract' => $employee->end_of_contract,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Position',
            'Department',
            'Start of Contract',
            'End of Contract'
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\FoodGroupModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupExport implements FromQuery, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    public function query()
    {
        return FoodGroupModel::query()->select('group', 'description', 'status');
    }

    public function headings(): array
    {
        return [
            'No',
            'Group',
            'Description',
            'Status'
        ];
    }
    public function map($row): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $row->group,
            $row->description,
            $row->status
        ];
    }
}

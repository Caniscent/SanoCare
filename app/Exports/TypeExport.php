<?php

namespace App\Exports;

use App\Models\FoodTypeModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class TypeExport implements FromQuery, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    public function query()
    {
        return FoodTypeModel::query()->select('type', 'description', 'status');
    }

    public function headings(): array
    {
        return [
            'No',
            'Type',
            'Description',
            'Status'
        ];
    }

    public function map($row): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $row->type,
            $row->description,
            $row->status      
        ];
    }
}

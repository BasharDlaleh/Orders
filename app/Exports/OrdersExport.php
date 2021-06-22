<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements WithMapping, FromCollection, WithHeadings
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    { 
        return  Order::with('customer:id,name')->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($model): array
    {
        $rows = [];

                array_push($rows,[
                    $model->id,
                    $model->name,
                    $model->customer->name,
                    $model->created_at,
                    ]);

            return $rows;
    }

    public function headings(): array
    {

        $columns = ['Id', 'Name', 'Customer', 'Created_At'];

        return $columns;
    }
}

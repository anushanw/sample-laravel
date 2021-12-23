<?php

namespace App\Imports\Logistics3P;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ReceiptImport implements ToCollection, WithCalculatedFormulas, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        return $collection;
    }
}

<?php

namespace App\Imports;

use App\Models\Dpk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DpkImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        dd($row);
        return new Dpk([
            //
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

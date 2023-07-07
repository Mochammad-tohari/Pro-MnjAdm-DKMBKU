<?php

namespace App\Exports;

use App\Models\uji_model;
use Maatwebsite\Excel\Concerns\FromCollection;

class export_excel_uji implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return uji_model::all();

    }
}

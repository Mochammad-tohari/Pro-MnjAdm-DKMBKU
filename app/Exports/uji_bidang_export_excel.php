<?php

namespace App\Exports;

use App\Models\uji_bidang_model;
use Maatwebsite\Excel\Concerns\FromCollection;

class uji_bidang_export_excel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return uji_bidang_model::all();
    }
}

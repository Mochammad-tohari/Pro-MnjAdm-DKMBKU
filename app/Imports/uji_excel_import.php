<?php

namespace App\Imports;

use App\Models\uji_model;
use Maatwebsite\Excel\Concerns\ToModel;

class uji_excel_import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new uji_model([
            
            'Kode' => $row[1],
            'Nama' => $row[2],
            'Password' => $row[3],
            'Tanggal_masuk' => $row[4],
            'Status' => $row[5],
            'Foto1' => $row[6],
            'Foto2' => $row[7]
        ]);


    }
}

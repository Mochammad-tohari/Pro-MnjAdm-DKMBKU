<?php

namespace App\Imports;

use App\Models\uji_bidang_model;
use Maatwebsite\Excel\Concerns\ToModel;

class uji_bidang_import_excel implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new uji_bidang_model([


            'Kode_Bidang' => $row[1],
            'Nama_Bidang' => $row[2],
            'Keterangan_Bidang' => $row[3],
            'Status_Bidang' => $row[4],


        ]);
    }
}

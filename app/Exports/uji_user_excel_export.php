<?php

namespace App\Exports;

use App\Models\uji_user_model;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\uji_bidang_model;

class uji_user_excel_export implements FromCollection
{

    /*
        syntax membuat file export excel, nama model harus sesuai dengan yang ada di folder Models

        php artisan make:export uji_user_excel_export  --model=uji_user_model
    */

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $uji_user_data = uji_user_model::all();

        /*
            Mengubah Kode_Bidang yang berupa tulisan kode menjadi Nama_Bidang sesuai dengan uji_bidang_model
        */
        $uji_user_data->transform(function ($row) {
            if ($row->ambil_kode_uji_bidang) {
                $row->Nama_Bidang = $row->ambil_kode_uji_bidang->Nama_Bidang;
            } else {
                $row->Nama_Bidang = 'Jabatan Tidak Diketahui';
            }
            unset ($row->Kode_Bidang); // Remove the original Kode_Bidang column
            return $row;
        });

        return $uji_user_data;
    }


}

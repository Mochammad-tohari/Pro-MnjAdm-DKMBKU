<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//import table model dari folder models
use App\Models\uji_model;

use App\Models\uji_bidang_model;
use App\Models\uji_user_model;

use App\Models\gedung_model;
use App\Models\ruangan_model;

use App\Models\murid_madrasah_model;

use App\Models\bidang_khodim_model;
use App\Models\khodim_dkm_model;

use App\Models\bidang_pengurus_dkm_model;
use App\Models\pengurus_dkm_model;

use App\Models\bidang_nawa_model;
use App\Models\pengurus_nawa_model;

use App\Models\inventaris_model;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function welcome()
    {
        // menghitung jumlah data di tabel uji_user
        $uji_user_jumlah = uji_user_model::count();

        // menghitung berdasarkan Status_Uji_User dengan kondisi yang ada
        $uji_user_kondisi = [
            //menghitung total jumlah data uji_user
            'uji_user_jumlah' => $uji_user_jumlah,

            // Menghitung 'Aktif' Status_Uji_User records
            'uji_user_aktif_count' => uji_user_model::where('Status_Uji_User', 'Aktif')->count(),
            // Menghitung 'Tidak_Aktif' Status_Uji_User records
            'uji_user_tidak_aktif_count' => uji_user_model::where('Status_Uji_User', 'Tidak_Aktif')->count(),
            // Menghitung 'Tidak_Aktif' Status_Uji_User records
            'uji_user_lainya_count' => uji_user_model::where('Status_Uji_User', 'Lainya')->count(),
            // tambah parameter atau kondisi jika dibutuhkan (perlu migrasi table baru)

            /*
                $uji_user_kondisi
                variable diatas akan di gunakan utk mengambil jumlah data di file welcome.blade.php

                uji_user_aktif_count , uji_user_tidak_aktif_count, uji_user_lainya_count
                ketiga parameter diatas akan di gunakan utk mengambil jumlah data di file welcome.blade.php dengan kondisi yang telah ditetapkan
            */
        ];

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Count total records
        $data_gedung_jumlah = gedung_model::count();

        // Define an array of variables to pass to the view
        $data_gedung_kondisi = [
            'data_gedung_jumlah' => $data_gedung_jumlah,
            // Count 'Aktif' status records
            'gedung_aktif_count' => gedung_model::where('Status_Gedung', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'gedung_tidak_aktif_count' => gedung_model::where('Status_Gedung', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'gedung_lainya_count' => gedung_model::where('Status_Gedung', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        // Count total records
        $data_ruangan_jumlah = ruangan_model::count();

        // Define an array of variables to pass to the view
        $data_ruangan_kondisi = [
            'data_ruangan_jumlah' => $data_ruangan_jumlah,
            // Count 'Aktif' status records
            'ruangan_aktif_count' => ruangan_model::where('Status_ruangan', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'ruangan_tidak_aktif_count' => ruangan_model::where('Status_ruangan', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'ruangan_lainya_count' => ruangan_model::where('Status_ruangan', 'Lainya')->count(),
            // Add more variables here if needed
        ];


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Count total records
        $data_murid_jumlah = murid_madrasah_model::count();

        // Define an array of variables to pass to the view
        $data_murid_kondisi = [
            'data_murid_jumlah' => $data_murid_jumlah,
            // Count 'Aktif' status records
            'murid_aktif_count' => murid_madrasah_model::where('Status_Murid', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'murid_tidak_aktif_count' => murid_madrasah_model::where('Status_Murid', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'murid_lainya_count' => murid_madrasah_model::where('Status_Murid', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        // Count total records
        $data_bidang_khodim_jumlah = bidang_khodim_model::count();

        // Define an array of variables to pass to the view
        $data_bidang_khodim_kondisi = [
            'data_bidang_khodim_jumlah' => $data_bidang_khodim_jumlah,
            // Count 'Aktif' status records
            'bidang_khodim_aktif_count' => bidang_khodim_model::where('Status_Bidang_Khodim', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'bidang_khodim_tidak_aktif_count' => bidang_khodim_model::where('Status_Bidang_Khodim', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'bidang_khodim_lainya_count' => bidang_khodim_model::where('Status_Bidang_Khodim', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        // Count total records
        $data_khodim_dkm_jumlah = khodim_dkm_model::count();

        // Define an array of variables to pass to the view
        $data_khodim_dkm_kondisi = [
            'data_khodim_dkm_jumlah' => $data_khodim_dkm_jumlah,
            // Count 'Aktif' status records
            'khodim_dkm_aktif_count' => khodim_dkm_model::where('Status_Khodim', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'khodim_dkm_tidak_aktif_count' => khodim_dkm_model::where('Status_Khodim', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'khodim_dkm_lainya_count' => khodim_dkm_model::where('Status_Khodim', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Count total records
        $data_bidang_pengurus_dkm_jumlah = bidang_pengurus_dkm_model::count();

        // Define an array of variables to pass to the view
        $data_bidang_pengurus_dkm_kondisi = [
            'data_bidang_pengurus_dkm_jumlah' => $data_bidang_pengurus_dkm_jumlah,
            // Count 'Aktif' status records
            'bidang_pengurus_dkm_aktif_count' => bidang_pengurus_dkm_model::where('Status_Bidang_Pengurus_DKM', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'bidang_pengurus_dkm_tidak_aktif_count' => bidang_pengurus_dkm_model::where('Status_Bidang_Pengurus_DKM', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'bidang_pengurus_dkm_lainya_count' => bidang_pengurus_dkm_model::where('Status_Bidang_Pengurus_DKM', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        // Count total records
        $data_pengurus_dkm_jumlah = pengurus_dkm_model::count();

        // Define an array of variables to pass to the view
        $data_pengurus_dkm_kondisi = [
            'data_pengurus_dkm_jumlah' => $data_pengurus_dkm_jumlah,
            // Count 'Aktif' status records
            'pengurus_dkm_aktif_count' => pengurus_dkm_model::where('Status_Pengurus_DKM', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'pengurus_dkm_tidak_aktif_count' => pengurus_dkm_model::where('Status_Pengurus_DKM', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'pengurus_dkm_lainya_count' => pengurus_dkm_model::where('Status_Pengurus_DKM', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Count total records
        $data_bidang_nawa_jumlah = bidang_nawa_model::count();

        // Define an array of variables to pass to the view
        $data_bidang_nawa_kondisi = [
            'data_bidang_nawa_jumlah' => $data_bidang_nawa_jumlah,
            // Count 'Aktif' status records
            'bidang_nawa_aktif_count' => bidang_nawa_model::where('Status_Bidang_Nawa', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'bidang_nawa_tidak_aktif_count' => bidang_nawa_model::where('Status_Bidang_Nawa', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'bidang_nawa_lainya_count' => bidang_nawa_model::where('Status_Bidang_Nawa', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        // Count total records
        $data_pengurus_nawa_jumlah = pengurus_nawa_model::count();

        // Define an array of variables to pass to the view
        $data_pengurus_nawa_kondisi = [
            'data_pengurus_nawa_jumlah' => $data_pengurus_nawa_jumlah,
            // Count 'Aktif' status records
            'pengurus_nawa_aktif_count' => pengurus_nawa_model::where('Status_Pengurus_Nawa', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'pengurus_nawa_tidak_aktif_count' => pengurus_nawa_model::where('Status_Pengurus_Nawa', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'pengurus_nawa_lainya_count' => pengurus_nawa_model::where('Status_Pengurus_Nawa', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Count total records
        $data_inventaris_jumlah = inventaris_model::count();

        // Define an array of variables to pass to the view
        $data_inventaris_kondisi = [
            'data_inventaris_jumlah' => $data_inventaris_jumlah,
            // Count 'Aktif' status records
            'inventaris_aktif_count' => inventaris_model::where('Status_Inventaris', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'inventaris_tidak_aktif_count' => inventaris_model::where('Status_Inventaris', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'inventaris_lainya_count' => inventaris_model::where('Status_Inventaris', 'Lainya')->count(),
            // Add more variables here if needed
        ];


        // Pass all the data variables to the view
        return view('welcome', [
            'uji_user_kondisi' => $uji_user_kondisi,
            'data_gedung_kondisi' => $data_gedung_kondisi,
            'data_ruangan_kondisi' => $data_ruangan_kondisi,
            'data_murid_kondisi' => $data_murid_kondisi,
            'data_bidang_khodim_kondisi' => $data_bidang_khodim_kondisi,
            'data_khodim_dkm_kondisi' => $data_khodim_dkm_kondisi,
            'data_bidang_pengurus_dkm_kondisi' => $data_bidang_pengurus_dkm_kondisi,
            'data_pengurus_dkm_kondisi' => $data_pengurus_dkm_kondisi,
            'data_bidang_nawa_kondisi' => $data_bidang_nawa_kondisi,
            'data_pengurus_nawa_kondisi' => $data_pengurus_nawa_kondisi,
            'data_inventaris_kondisi' => $data_inventaris_kondisi,

        ]);
    }
}


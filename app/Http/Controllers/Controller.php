<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//import table model
use App\Models\uji_model;
use App\Models\gedung_model;
use App\Models\ruangan_model;
use App\Models\murid_madrasah_model;
use App\Models\bidang_khodim_model;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function welcome()
    {
        // Count total records for data_uji
        $data_uji_jumlah = uji_model::count();

        // Define an array of variables for data_uji
        $data_uji_kondisi = [
            'data_uji_jumlah' => $data_uji_jumlah,
            // Count 'Aktif' status records
            'aktif_count' => uji_model::where('Status', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'tidak_aktif_count' => uji_model::where('Status', 'Tidak_Aktif')->count(),
            // Add more variables here if needed
        ];

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

        // Count total records
        $data_murid_jumlah = murid_madrasah_model::count();

        // Define an array of variables to pass to the view
        $data_murid_kondisi = [
            'data_murid_jumlah' => $data_murid_jumlah,
            // Count 'Aktif' status records
            'murid_aktif_count' => murid_madrasah_model::where('Status_Murid', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'murid_tidak_aktif_count' => murid_madrasah_model::where('Status_Murid', 'Tidak_Aktif')->count(),
            // Count 'Pindah' status records
            'murid_pindah_count' => murid_madrasah_model::where('Status_Murid', 'Pindah')->count(),
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

        // Pass all the data variables to the view
        return view('welcome', [
            'data_uji_kondisi' => $data_uji_kondisi,
            'data_gedung_kondisi' => $data_gedung_kondisi,
            'data_ruangan_kondisi' => $data_ruangan_kondisi,
            'data_murid_kondisi' => $data_murid_kondisi,
            'data_bidang_khodim_kondisi' => $data_bidang_khodim_kondisi,
        ]);
    }
}


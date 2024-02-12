<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "pengurus_dkm_model" dari folder models
use App\Models\pengurus_dkm_model;

//import Model "bidang_pengurus_model" dari folder models
use App\Models\bidang_pengurus_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

// //import method export Excel
// use App\Exports\export_excel_uji;

// //import method export Excel di folder Exports
// use App\Imports\uji_excel_import;

// //import method import Excel di folder Imports
// use Maatwebsite\Excel\Facades\Excel;

//import class Session
use Illuminate\Support\Facades\Session;

class pengurus_dkm_controller extends Controller
{

    public function pengurus_dkm_index(Request $request)
    {
        /*
        $pengurus_dkm_data pernyataan variabel
        pengurus_dkm_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $pengurus_dkm_data = pengurus_dkm_model::orderBy('Nama_Pengurus', 'asc')
            ->paginate(5);


        // memanggil data gedung yang ada di table pengurus_dkm
        $pengurus_dkm_data = pengurus_dkm_model::with('ambil_kode_bidang_pengurus')->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $pengurus_dkm_data = pengurus_dkm_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Pengurus', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Pengurus', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $pengurus_dkm_data = pengurus_dkm_model::orderBy('Nama_Pengurus', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('pengurus_dkm_data', [
            'pengurus_dkm_data' => $pengurus_dkm_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'pengurus_dkm_data' diambil dari pengurus_dkm_data.blade.php, compact 'pengurus_dkm_data', diambil dari variabel $pengurus_dkm_data
        */
        return view('pengurus_dkm_data', compact('pengurus_dkm_data'));
    }

}

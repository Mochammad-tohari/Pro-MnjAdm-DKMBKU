<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import Model "bidang_khodim_model" dari folder models
use App\Models\bidang_khodim_model;

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

class bidang_khodim_controller extends Controller
{
    public function bidang_khodim_index(Request $request)
    {
        /*
        $bidang_khodim_data pernyataan variabel
        bidang_khodim_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $bidang_khodim_data = bidang_khodim_model::orderBy('Nama_Bidang_Khodim', 'asc')
                                -> paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $bidang_khodim_data = bidang_khodim_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Bidang_Khodim', 'LIKE', '%' . $searchQuery . '%')
                      ->orWhere('Kode_Bidang_Khodim', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $bidang_khodim_data = bidang_khodim_model::orderBy('Nama_Bidang_Khodim', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('bidang_khodim_data', [
            'bidang_khodim_data' => $bidang_khodim_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'bidang_khodim_data' diambil dari bidang_khodim_data.blade.php, compact 'bidang_khodim_data', diambil dari variabel $bidang_khodim_data
        */
        return view('bidang_khodim_data',compact ('bidang_khodim_data'));

    }
}

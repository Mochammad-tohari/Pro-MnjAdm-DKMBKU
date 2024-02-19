<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "uji_bidang_model" dari folder models
use App\Models\uji_bidang_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import method export Excel
use App\Exports\export_excel_uji;

//import method export Excel di folder Exports
use App\Imports\uji_excel_import;

//import method import Excel di folder Imports
use Maatwebsite\Excel\Facades\Excel;

//import class Session
use Illuminate\Support\Facades\Session;

class uji_bidang_controller extends Controller
{
    // untuk index data uji_bidang berfungsi untuk menampilkan data
    public function uji_bidang_index(Request $request)
    {
        /*
        $uji_bidang_data pernyataan variabel
        uji_bidang_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $uji_bidang_data = uji_bidang_model::orderBy('Nama_Bidang', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $uji_bidang_data = uji_bidang_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Bidang', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Bidang', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $uji_bidang_data = uji_bidang_model::orderBy('Nama_Bidang', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('uji_bidang_data', [
            'uji_bidang_data' => $uji_bidang_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'uji_bidang_data' diambil dari uji_bidang_data.blade.php, compact 'uji_bidang_data', diambil dari variabel $data_uji_bidang
        */
        return view('uji_bidang_data', compact('uji_bidang_data'));

    }
}

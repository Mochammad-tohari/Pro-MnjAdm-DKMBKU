<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "uji_bidang_model" dari folder models
use App\Models\uji_bidang_model;

//import Model "uji_user_model" dari folder models
use App\Models\uji_user_model;

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

class uji_user_controller extends Controller
{
    // untuk index data uji berfungsi untuk menampilkan data
    public function uji_user_index(Request $request)
    {
        /*
        $uji_user_data pernyataan variabel
        uji_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $uji_user_data = uji_user_model::orderBy('Nama_Uji_User', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $uji_user_data = uji_user_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Uji_User', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Uji_User', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $uji_user_data = uji_user_model::orderBy('Nama_Uji_User', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('uji_user_data', [
            'uji_user_data' => $uji_user_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'uji_user_data' diambil dari uji_user_data.blade.php, compact 'uji_user_data', diambil dari variabel $uji_user_data
        */
        return view('uji_user_data', compact('uji_user_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}

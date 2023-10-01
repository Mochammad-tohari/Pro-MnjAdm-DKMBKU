<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//import Model "khodim_dkm_model" dari folder models
use App\Models\khodim_dkm_model;

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

class khodim_dkm_controller extends Controller
{

    public function khodim_dkm_index(Request $request)
    {
        /*
        $khodim_dkm_data pernyataan variabel
        khodim_dkm_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $khodim_dkm_data = khodim_dkm_model::orderBy('Nama_Khodim', 'asc')
                                -> paginate(5);


        // memanggil data gedung yang ada di table khodim_dkm
        $khodim_dkm_data = khodim_dkm_model::with('ambil_kode_bidang_khodim')->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $khodim_dkm_data = khodim_dkm_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Khodim', 'LIKE', '%' . $searchQuery . '%')
                      ->orWhere('Kode_Khodim', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $khodim_dkm_data = khodim_dkm_model::orderBy('Nama_Khodim', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('khodim_dkm_data', [
            'khodim_dkm_data' => $khodim_dkm_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'khodim_dkm_data' diambil dari khodim_dkm_data.blade.php, compact 'khodim_dkm_data', diambil dari variabel $khodim_dkm_data
        */
        return view('khodim_dkm_data',compact ('khodim_dkm_data'));

    }


     public function khodim_dkm_create()
    {

        // $bidang_khodim_option
        // bidang_Khodim_model::pluck('Nama_bidang_Khodim', 'Kode_bidang_Khodim'); = mengambil nama bidang_Khodim berdasarkan kode bidang_Khodim yang ada di table bidang_Khodim

        $bidang_khodim_option = bidang_Khodim_model::pluck('Nama_Bidang_Khodim', 'Kode_Bidang_Khodim');
        return view('khodim_dkm_create',compact ('bidang_khodim_option'));

    }

    public function khodim_dkm_insert(Request $request)
    {
        //dd($request->all());


        // Create a new instance of khodim_dkm_model
        $khodim_dkm_data = new khodim_dkm_model();

        // Assign the input 'Jabatan_Khodim' value to the 'Jabatan_Khodim' property ada di table khodim_dkm
        $khodim_dkm_data->Jabatan_Khodim = $request->input('Jabatan_Khodim');

        // Assign other fields in the $khodim_dkm_data model as per your form data
        $khodim_dkm_data->otherField = $request->input('otherField');
        // ... continue assigning other fields


         // Save the $khodim_dkm_data object to the database
         $khodim_dkm_data = khodim_dkm_model::create($request->all());

        if ($request->hasFile('Foto_Khodim')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Khodim')->getClientOriginalName();
            $request->file('Foto_Khodim')->move(public_path('Data_Khodim/Foto_Khodim'), $filename1);
            $khodim_dkm_data->Foto_Khodim = $filename1;
        }

        if ($request->hasFile('Identitas_Khodim')) {
            $filename2 = date('Y-m-d') . '_' . $request->file('Identitas_Khodim')->getClientOriginalName();
            $request->file('Identitas_Khodim')->move(public_path('Data_Khodim/Identitas_Khodim'), $filename2);
            $khodim_dkm_data->Identitas_Khodim = $filename2;
        }


        $khodim_dkm_data->save();

        return redirect()->route('khodim_dkm_index')->with('success', 'Data Berhasil Dimasukan');
    }


}

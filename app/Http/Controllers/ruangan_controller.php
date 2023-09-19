<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import Model "ruangan_model" dari folder models
use App\Models\ruangan_model;

//import Model "gedung_model" dari folder models
use App\Models\gedung_model;

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

class ruangan_controller extends Controller
{
    public function ruangan_index(Request $request)
    {
        /*
        $ruangan_data pernyataan variabel
        ruangan_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $ruangan_data = ruangan_model::orderBy('Nama_Ruangan', 'asc')
                                -> paginate(5);


        // memanggil data gedung yang ada di table ruangan
        $ruangan_data = ruangan_model::with('gedung')->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $ruangan_data = ruangan_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Ruangan', 'LIKE', '%' . $searchQuery . '%')
                      ->orWhere('Kode_Ruangan', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $ruangan_data = ruangan_model::orderBy('Nama_Ruangan', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('ruangan_data', [
            'ruangan_data' => $ruangan_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'ruangan_data' diambil dari ruangan_data.blade.php, compact 'ruangan_data', diambil dari variabel $ruangan_data
        */
        return view('ruangan_data',compact ('ruangan_data'));

    }

    public function ruangan_create()
    {

        // $gedungOptions
        // gedung_model::pluck('Nama_Gedung', 'Kode_Gedung'); = mengambil nama gedung berdasarkan kode gedung yang ada di table gedung

        $gedungOptions = gedung_model::pluck('Nama_Gedung', 'Kode_Gedung');
        return view('ruangan_create',compact ('gedungOptions'));

    }

    public function ruangan_insert(Request $request)
    {
        //dd($request->all());

        // Create a new instance of Ruangan
        $ruangan = new ruangan_model();

        // Assign the input 'Kode_Gedung' value to the 'Kode_Gedung' property
        $ruangan->Kode_Gedung = $request->input('Kode_Gedung');

        // Assign other fields in the $ruangan model as per your form data
        $ruangan->otherField = $request->input('otherField');
        // ... continue assigning other fields

                $ruangan_data = ruangan_model::create($request->all());
                $ruangan_data->save();

                return redirect()->route('ruangan_index')->with('success', 'Data Berhasil Dimasukan');

    }

    public function ruangan_edit($id_ruangan)
    {

        // $gedungOptions
        // gedung_model::pluck('Nama_Gedung', 'Kode_Gedung'); = mengambil nama gedung berdasarkan kode gedung yang ada di table gedung

        $ruangan_data = ruangan_model::findOrFail($id_ruangan);

        $gedungOptions = gedung_model::pluck('Nama_Gedung', 'Kode_Gedung');

        return view('ruangan_edit', compact('ruangan_data', 'gedungOptions'));

    }

    public function ruangan_update(Request $request, $id_ruangan)
    {
        $ruangan_data = ruangan_model::findOrFail($id_ruangan);
        $ruangan_data->Gedung_Kode = $request->input('Gedung_Kode');

        $ruangan_data->update($request->all());
        // Update other fields in the $ruangan model as per your form data
        $ruangan_data->save();


        // Redirect or return response as needed
        if(session('page_url')){
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('ruangan_index')->with('success_edit', 'Data Berhasil Diubah');
    }

    public function ruangan_export_pdf()
    {
        $ruangan_data = ruangan_model::orderBy('Nama_Ruangan', 'asc')->get();

        view()->share('ruangan_data', $ruangan_data);
        $ruangan_pdf = PDF::loadview('ruangan_export-pdf');
        return $ruangan_pdf->download('data_ruangan.pdf');


    }

    public function show($kode_ruangan)
    {
        $ruangan_data = ruangan_model::where('Kode_Ruangan', $kode_ruangan)->first();

        if ($ruangan_data) {
            return view('ruangan.show', ['ruangan_data' => $ruangan_data]);
        } else {
            return redirect()->route('ruangan_index')->with('error', 'Data not found.');
        }
    }

    // untuk lihat data uji berfungsi untuk melihat 1 data
    public function ruangan_view($id_ruangan)
    {

    $ruangan_data = ruangan_model::find($id_ruangan);
    return view('ruangan_view', compact('ruangan_data'));

    }


}

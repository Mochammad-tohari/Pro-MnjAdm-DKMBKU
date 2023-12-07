<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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


class bidang_pengurus_controller extends Controller {
    public function bidang_pengurus_index(Request $request) {
        /*
        $bidang_pengurus_data pernyataan variabel
        bidang_pengurus_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $bidang_pengurus_data = bidang_pengurus_model::orderBy('Nama_Bidang_Pengurus', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if($request->has('search')) {
            $bidang_pengurus_data = bidang_pengurus_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Bidang_Pengurus', 'LIKE', '%'.$searchQuery.'%')
                    ->orWhere('Kode_Bidang_Pengurus', 'LIKE', '%'.$searchQuery.'%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $bidang_pengurus_data = bidang_pengurus_model::orderBy('Nama_Bidang_Pengurus', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('bidang_pengurus_data', [
            'bidang_pengurus_data' => $bidang_pengurus_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'bidang_pengurus_data' diambil dari bidang_pengurus_data.blade.php, compact 'bidang_pengurus_data', diambil dari variabel $bidang_pengurus_data
        */
        return view('bidang_pengurus_data', compact('bidang_pengurus_data'));

    }

    public function bidang_pengurus_create() {

        return view('bidang_pengurus_create');

    }


    public function bidang_pengurus_insert(Request $request) {
        //dd($request->all());


        $bidang_pengurus_data = bidang_pengurus_model::create($request->all());

        $bidang_pengurus_data->save();

        return redirect()->route('bidang_pengurus_index')->with('success', 'Data Berhasil Dimasukan');

    }

    public function bidang_pengurus_edit($id_bidang_pengurus) {

        $bidang_pengurus_data = bidang_pengurus_model::find($id_bidang_pengurus);

        return view('bidang_pengurus_edit', compact('bidang_pengurus_data'));
    }


    public function bidang_pengurus_update(Request $request, $id_bidang_pengurus) {

        $bidang_pengurus_data = bidang_pengurus_model::findOrFail($id_bidang_pengurus); // Assuming you have the ID of the row you want to update

        $bidang_pengurus_data->update($request->all());

        $bidang_pengurus_data->save();

        if(session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('bidang_pengurus_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    public function bidang_pengurus_export_pdf() {
        $bidang_pengurus_data = bidang_pengurus_model::orderBy('Nama_Bidang_Pengurus', 'asc')->get();

        view()->share('bidang_pengurus_data', $bidang_pengurus_data);
        $bidang_pengurus_pdf = PDF::loadview('bidang_pengurus_export-pdf');
        return $bidang_pengurus_pdf->download('data_bidang_pengurus.pdf');


    }
}

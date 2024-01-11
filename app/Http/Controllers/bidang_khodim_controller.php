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
            ->paginate(5);

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
        return view('bidang_khodim_data', compact('bidang_khodim_data'));

    }

    public function bidang_khodim_create()
    {

        return view('bidang_khodim_create');

    }


    public function bidang_khodim_insert(Request $request)
    {
        //dd($request->all());

        // Create a new instance of bidang_khodim
        $bidang_khodim_data = new bidang_khodim_model();
        //pengisian model table dengan pengecualian 'updated_by'
        $bidang_khodim_data->fill($request->except('updated_by'));

        // mengatur updated email utk menghindari isi otomatis di fungsi insert
        $bidang_khodim_data->updated_by = null;


        $bidang_khodim_data = bidang_khodim_model::create($request->all());

        $bidang_khodim_data->save();

        return redirect()->route('bidang_khodim_index')->with('success', 'Data Berhasil Dimasukan');

    }

    public function bidang_khodim_edit($id_bidang_khodim)
    {

        $bidang_khodim_data = bidang_khodim_model::find($id_bidang_khodim);

        return view('bidang_khodim_edit', compact('bidang_khodim_data'));
    }


    public function bidang_khodim_update(Request $request, $id_bidang_khodim)
    {

        $bidang_khodim_data = bidang_khodim_model::findOrFail($id_bidang_khodim); // Assuming you have the ID of the row you want to update

        $bidang_khodim_data->update($request->all());

        $bidang_khodim_data->save();

        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('bidang_khodim_index')->with('success_edit', 'Data Berhasil Diubah');


    }


    public function bidang_khodim_export_pdf()
    {
        $bidang_khodim_data = bidang_khodim_model::orderBy('Nama_Bidang_Khodim', 'asc')->get();

        view()->share('bidang_khodim_data', $bidang_khodim_data);
        $bidang_khodim_pdf = PDF::loadview('bidang_khodim_export-pdf');
        return $bidang_khodim_pdf->download('data_bidang_khodim.pdf');


    }


}

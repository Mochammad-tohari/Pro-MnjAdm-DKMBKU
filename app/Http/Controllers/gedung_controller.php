<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

class gedung_controller extends Controller
{
    public function gedung_index(Request $request)
    {
        /*
        $gedung_data pernyataan variabel
        gedung_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $gedung_data = gedung_model::orderBy('Nama_Gedung', 'asc')
                                -> paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $gedung_data = gedung_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Gedung', 'LIKE', '%' . $searchQuery . '%')
                      ->orWhere('Kode_Gedung', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $gedung_data = gedung_model::orderBy('Nama_Gedung', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('gedung_data', [
            'gedung_data' => $gedung_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'gedung_data' diambil dari gedung_data.blade.php, compact 'gedung_data', diambil dari variabel $gedung_data
        */
        return view('gedung_data',compact ('gedung_data'));

    }

    public function gedung_create()
    {

        return view('gedung_create');

    }

    public function gedung_insert(Request $request)
    {
        //dd($request->all());


                $gedung_data = gedung_model::create($request->all());

                $gedung_data->save();

                return redirect()->route('gedung_index')->with('success', 'Data Berhasil Dimasukan');

    }

    public function gedung_edit($id)
    {

        $gedung_data = gedung_model::find($id);

        return view('gedung_edit', compact('gedung_data'));
    }

    public function gedung_update(Request $request, $id)
    {

        $gedung_data = gedung_model::findOrFail($id); // Assuming you have the ID of the row you want to update

        $gedung_data->update($request->all());

        $gedung_data->save();

        if(session('page_url')){
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('gedung_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    public function gedung_export_pdf()
    {
        $gedung_data = gedung_model::orderBy('Nama_Gedung', 'asc')->get();

        view()->share('gedung_data', $gedung_data);
        $gedung_pdf = PDF::loadview('gedung_export-pdf');
        return $gedung_pdf->download('data_gedung.pdf');


    }


}

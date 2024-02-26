<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "gedung_model" dari folder models
use App\Models\gedung_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

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
            ->paginate(5);

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
        return view('gedung_data', compact('gedung_data'));

    }

    public function gedung_create()
    {

        return view('gedung_create');

    }

    public function gedung_insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Nama_Gedung' => 'required',
            'Dimensi_Gedung' => 'required',
            'Status_Gedung' => 'required',
        ]);

        if ($validator->passes()) {
            //dd($request->all());
            // Create a new instance of gedung
            $gedung_data = new gedung_model();
            //pengisian model table dengan pengecualian 'updated_by'
            $gedung_data->fill($request->except('updated_by'));

            // mengatur updated email utk menghindari isi otomatis di fungsi insert
            $gedung_data->updated_by = null;

            if ($request->hasFile('Foto_Gedung')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Gedung')->getClientOriginalName();
                $request->file('Foto_Gedung')->move(public_path('Data_Gedung/Foto_Gedung'), $filename1);
                $gedung_data->Foto_Gedung = $filename1;
            }

            $gedung_data->save();

            return redirect()->route('gedung_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }


    }

    public function gedung_edit($id_gedung)
    {

        $gedung_data = gedung_model::find($id_gedung);

        return view('gedung_edit', compact('gedung_data'));
    }

    public function gedung_update(Request $request, $id_gedung)
    {

        $gedung_data = gedung_model::findOrFail($id_gedung); // Assuming you have the ID of the row you want to update

        $gedung_data->update($request->all());

        if ($request->hasFile('Foto_Gedung')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Gedung')->getClientOriginalName();
            $request->file('Foto_Gedung')->move(public_path('Data_Gedung/Foto_Gedung'), $filename1);
            $gedung_data->Foto_Gedung = $filename1;
        }

        $gedung_data->save();

        if (session('page_url')) {
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

    public function show($kode_gedung)
    {
        $gedung_data = gedung_model::where('Kode_Gedung', $kode_gedung)->first();

        if ($gedung_data) {
            return view('gedung.show', ['gedung_data' => $gedung_data]);
        } else {
            return redirect()->route('gedung_index')->with('error', 'Data not found.');
        }
    }

    // untuk lihat data uji berfungsi untuk melihat 1 data
    public function gedung_view($id_gedung)
    {

        $gedung_data = gedung_model::find($id_gedung);
        return view('gedung_view', compact('gedung_data'));

    }
}

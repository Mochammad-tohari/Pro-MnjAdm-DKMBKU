<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "bidang_nawa_model" dari folder models
use App\Models\bidang_nawa_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class bidang_nawa_controller extends Controller
{
    public function bidang_nawa_index(Request $request)
    {
        /*
        $bidang_nawa_data pernyataan variabel
        bidang_nawa_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $bidang_nawa_data = bidang_nawa_model::orderBy('Nama_Bidang_Nawa', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $bidang_nawa_data = bidang_nawa_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Bidang_Nawa', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Bidang_Nawa', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $bidang_nawa_data = bidang_nawa_model::orderBy('Nama_Bidang_Nawa', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('bidang_nawa_data', [
            'bidang_nawa_data' => $bidang_nawa_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'bidang_nawa_data' diambil dari bidang_nawa_data.blade.php, compact 'bidang_nawa_data', diambil dari variabel $bidang_nawa_data
        */
        return view('bidang_nawa_data', compact('bidang_nawa_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function bidang_nawa_create()
    {

        return view('bidang_nawa_create');

    }


    public function bidang_nawa_insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Nama_Bidang_Nawa' => 'required',
            'Status_Bidang_Nawa' => 'required',
        ]);

        if ($validator->passes()) {

            //dd($request->all());

            // Create a new instance of bidang_nawa
            $bidang_nawa_data = new bidang_nawa_model();
            //pengisian model table dengan pengecualian 'updated_by'
            $bidang_nawa_data->fill($request->except('updated_by'));

            // mengatur updated email utk menghindari isi otomatis di fungsi insert
            $bidang_nawa_data->updated_by = null;


            $bidang_nawa_data = bidang_nawa_model::create($request->all());

            $bidang_nawa_data->save();

            return redirect()->route('bidang_nawa_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function bidang_nawa_edit($id_bidang_nawa)
    {

        $bidang_nawa_data = bidang_nawa_model::find($id_bidang_nawa);

        return view('bidang_nawa_edit', compact('bidang_nawa_data'));
    }


    public function bidang_nawa_update(Request $request, $id_bidang_nawa)
    {

        $bidang_nawa_data = bidang_nawa_model::findOrFail($id_bidang_nawa); // Assuming you have the ID of the row you want to update

        $bidang_nawa_data->update($request->all());

        $bidang_nawa_data->save();

        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('bidang_nawa_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function bidang_nawa_export_pdf()
    {
        $bidang_nawa_data = bidang_nawa_model::orderBy('Nama_Bidang_Nawa', 'asc')->get();

        view()->share('bidang_nawa_data', $bidang_nawa_data);
        $bidang_nawa_pdf = PDF::loadview('bidang_nawa_export-pdf');
        return $bidang_nawa_pdf->download('data_bidang_nawa.pdf');


    }

}

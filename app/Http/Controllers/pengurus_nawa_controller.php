<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "pengurus_nawa_model" dari folder models
use App\Models\pengurus_nawa_model;

//import Model "bidang_nawa_model" dari folder models
use App\Models\bidang_nawa_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class pengurus_nawa_controller extends Controller
{
    public function pengurus_nawa_index(Request $request)
    {
        /*
        $pengurus_nawa_data pernyataan variabel
        pengurus_nawa_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $pengurus_nawa_data = pengurus_nawa_model::orderBy('Nama_Pengurus_Nawa', 'asc')
            ->paginate(5);



        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $pengurus_nawa_data = pengurus_nawa_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Pengurus_Nawa', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Pengurus_Nawa', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $pengurus_nawa_data = pengurus_nawa_model::orderBy('Nama_Pengurus_Nawa', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('pengurus_nawa_data', [
            'pengurus_nawa_data' => $pengurus_nawa_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'pengurus_nawa_data' diambil dari pengurus_nawa_data.blade.php, compact 'pengurus_nawa_data', diambil dari variabel $pengurus_nawa_data
        */
        return view('pengurus_nawa_data', compact('pengurus_nawa_data'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // insert data
    public function pengurus_nawa_create()
    {

        // $Bidang_Nawa_Options
        // bidang_pengurus_nawa_model::pluck('Nama_Bidang_Nawa', 'Kode_Bidang_Nawa'); = mengambil nama bidang_nawa berdasarkan kode bidang yang ada di table bidang_nawa

        $Bidang_Nawa_Options = bidang_nawa_model::pluck('Nama_Bidang_Nawa', 'Kode_Bidang_Nawa');
        return view('pengurus_nawa_create', compact('Bidang_Nawa_Options'));
    }

    public function pengurus_nawa_insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'Jabatan_Pengurus_Nawa' => 'required',
            'Nama_Pengurus_Nawa' => 'required',
            'Kontak_Pengurus_Nawa' => 'required',
            'Alamat_Pengurus_Nawa' => 'required',
            'Status_Pengurus_Nawa' => 'required',
        ]);

        if ($validator->passes()) {

            // Create a new instance of pengurus_nawa_model
            $pengurus_nawa_data = new pengurus_nawa_model();

            // Fill the model with form data (excluding updated_by)
            $pengurus_nawa_data->fill($request->except(['updated_by']));

            // Set the updated_by field to null initially
            $pengurus_nawa_data->updated_by = null;

            // Assign the input 'Jabatan_Pengurus_Nawa' value to the 'Jabatan_Pengurus_Nawa' property
            $pengurus_nawa_data->Jabatan_Pengurus_Nawa = $request->input('Jabatan_Pengurus_Nawa');

            // Check if 'Foto_Pengurus_Nawa' file is present in the request
            if ($request->hasFile('Foto_Pengurus_Nawa')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Pengurus_Nawa')->getClientOriginalName();
                $request->file('Foto_Pengurus_Nawa')->move(public_path('Data_Pengurus_Nawa/Foto_Pengurus_Nawa'), $filename1);
                $pengurus_nawa_data->Foto_Pengurus_Nawa = $filename1;
            }

            // Check if 'Identitas_Pengurus_Nawa' file is present in the request
            if ($request->hasFile('Identitas_Pengurus_Nawa')) {
                $filename2 = date('Y-m-d') . '_' . $request->file('Identitas_Pengurus_Nawa')->getClientOriginalName();
                $request->file('Identitas_Pengurus_Nawa')->move(public_path('Data_Pengurus_Nawa/Identitas_Pengurus_Nawa'), $filename2);
                $pengurus_nawa_data->Identitas_Pengurus_Nawa = $filename2;
            }

            // Save the updated files
            $pengurus_nawa_data->save();

            return redirect()->route('pengurus_nawa_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // edit data
    public function pengurus_nawa_edit($id_pengurus_nawa)
    {
        //dd($id_pengurus_nawa);

        // $bidang_pengurus_option

        $pengurus_nawa_data = pengurus_nawa_model::findOrFail($id_pengurus_nawa);
        // $Bidang_Nawa_Options
        // bidang_pengurus_nawa_model::pluck('Nama_Bidang_Nawa', 'Kode_Bidang_Nawa'); = mengambil nama bidang_nawa berdasarkan kode bidang yang ada di table bidang_nawa

        $Bidang_Nawa_Options = bidang_nawa_model::pluck('Nama_Bidang_Nawa', 'Kode_Bidang_Nawa');

        return view('pengurus_nawa_edit', compact('pengurus_nawa_data', 'Bidang_Nawa_Options'));
    }

    public function pengurus_nawa_update(Request $request, $id_pengurus_nawa)
    {
        $pengurus_nawa_data = pengurus_nawa_model::findOrFail($id_pengurus_nawa);

        $pengurus_nawa_data->Jabatan_Pengurus_Nawa = $request->input('Jabatan_Pengurus_Nawa');

        // Update the data with new values from the request
        $pengurus_nawa_data->fill($request->all());

        $pengurus_nawa_data->update($request->all());

        if ($request->hasFile('Foto_Pengurus_Nawa')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Pengurus_Nawa')->getClientOriginalName();
            $request->file('Foto_Pengurus_Nawa')->move(public_path('Data_Pengurus_Nawa/Foto_Pengurus_Nawa'), $filename1);
            $pengurus_nawa_data->Foto_Pengurus_Nawa = $filename1;
        }

        if ($request->hasFile('Identitas_Pengurus_Nawa')) {
            $filename2 = date('Y-m-d') . '_' . $request->file('Identitas_Pengurus_Nawa')->getClientOriginalName();
            $request->file('Identitas_Pengurus_Nawa')->move(public_path('Data_Pengurus_Nawa/Identitas_Pengurus_Nawa'), $filename2);
            $pengurus_nawa_data->Identitas_Pengurus_Nawa = $filename2;
        }

        $pengurus_nawa_data->save();


        // Redirect or return response as needed
        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('pengurus_nawa_index')->with('success_edit', 'Data Berhasil Diubah');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //export PDF
    public function pengurus_nawa_export_pdf()
    {

        $pengurus_nawa_data = pengurus_nawa_model::orderBy('Nama_Pengurus_Nawa', 'asc')->get();

        view()->share('pengurus_nawa_data', $pengurus_nawa_data);
        $pengurus_nawa_pdf = PDF::loadview('pengurus_nawa_export-pdf');

        return $pengurus_nawa_pdf->download('data_pengurus_nawa.pdf');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk lihat data uji berfungsi untuk melihat 1 data
    public function pengurus_nawa_view($id_pengurus_nawa)
    {

        /**
         * menampilkan halaman pengurus_nawa_view.blade.php
         * mencari data berdasarkan id_pengurus_nawa
         */
        $pengurus_nawa_data = pengurus_nawa_model::find($id_pengurus_nawa);
        return view('pengurus_nawa_view', compact('pengurus_nawa_data'));
    }

}

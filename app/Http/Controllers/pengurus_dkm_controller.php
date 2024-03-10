<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "pengurus_dkm_model" dari folder models
use App\Models\pengurus_dkm_model;

//import Model "bidang_pengurus_dkm_model" dari folder models
use App\Models\bidang_pengurus_dkm_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class pengurus_dkm_controller extends Controller
{

    public function pengurus_dkm_index(Request $request)
    {
        /*
        $pengurus_dkm_data pernyataan variabel
        pengurus_dkm_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $pengurus_dkm_data = pengurus_dkm_model::orderBy('Nama_Pengurus', 'asc')
            ->paginate(5);


        // memanggil data gedung yang ada di table pengurus_dkm
        $pengurus_dkm_data = pengurus_dkm_model::with('ambil_kode_bidang_pengurus')->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $pengurus_dkm_data = pengurus_dkm_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Pengurus', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Pengurus', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $pengurus_dkm_data = pengurus_dkm_model::orderBy('Nama_Pengurus', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('pengurus_dkm_data', [
            'pengurus_dkm_data' => $pengurus_dkm_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'pengurus_dkm_data' diambil dari pengurus_dkm_data.blade.php, compact 'pengurus_dkm_data', diambil dari variabel $pengurus_dkm_data
        */
        return view('pengurus_dkm_data', compact('pengurus_dkm_data'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function pengurus_dkm_create()
    {

        // $bidang_pengurus_option
        // bidang_pengurus_dkm_model::pluck('Nama_bidang_pengurus', 'Kode_bidang_pengurus'); = mengambil nama bidang_pengurus berdasarkan kode bidang_pengurus yang ada di table bidang_pengurus

        $Bidang_Pengurus_Options = bidang_pengurus_dkm_model::pluck('Nama_Bidang_Pengurus', 'Kode_Bidang_Pengurus');
        return view('pengurus_dkm_create', compact('Bidang_Pengurus_Options'));
    }

    public function pengurus_dkm_insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Jabatan_Pengurus' => 'required',
            'Nama_Pengurus' => 'required',
            'Kontak_Pengurus' => 'required',
            'Alamat_Pengurus' => 'required',
            'Status_Pengurus' => 'required',
        ]);

        if ($validator->passes()) {

            // Create a new instance of pengurus_dkm_model
            $pengurus_dkm_data = new pengurus_dkm_model();

            // Fill the model with form data (excluding updated_by)
            $pengurus_dkm_data->fill($request->except(['updated_by']));

            // Set the updated_by field to null initially
            $pengurus_dkm_data->updated_by = null;

            // Assign the input 'Jabatan_pengurus' value to the 'Jabatan_pengurus' property
            $pengurus_dkm_data->Jabatan_Pengurus = $request->input('Jabatan_Pengurus');

            // Check if 'Foto_Pengurus' file is present in the request
            if ($request->hasFile('Foto_Pengurus')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Pengurus')->getClientOriginalName();
                $request->file('Foto_Pengurus')->move(public_path('Data_Pengurus_DKM/Foto_Pengurus'), $filename1);
                $pengurus_dkm_data->Foto_Pengurus = $filename1;
            }

            // Check if 'Identitas_Pengurus' file is present in the request
            if ($request->hasFile('Identitas_Pengurus')) {
                $filename2 = date('Y-m-d') . '_' . $request->file('Identitas_Pengurus')->getClientOriginalName();
                $request->file('Identitas_Pengurus')->move(public_path('Data_Pengurus_DKM/Identitas_Pengurus'), $filename2);
                $pengurus_dkm_data->Identitas_Pengurus = $filename2;
            }

            // Save the updated files
            $pengurus_dkm_data->save();

            return redirect()->route('pengurus_dkm_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }


    }

    public function pengurus_dkm_edit($id_pengurus)
    {
        //dd($id_pengurus);

        // $bidang_pengurus_option
        // bidang_pengurus_dkm_model::pluck('Nama_bidang_Pengurus', 'Kode_bidang_Pengurus'); = mengambil nama bidang_Pengurus berdasarkan kode bidang_Pengurus yang ada di table bidang_Pengurus
        $pengurus_dkm_data = pengurus_dkm_model::findOrFail($id_pengurus);

        $Bidang_Pengurus_Options = bidang_pengurus_dkm_model::pluck('Nama_Bidang_Pengurus', 'Kode_Bidang_Pengurus');

        return view('pengurus_dkm_edit', compact('pengurus_dkm_data', 'Bidang_Pengurus_Options'));
    }

    public function pengurus_dkm_update(Request $request, $id_pengurus)
    {
        $pengurus_dkm_data = pengurus_dkm_model::findOrFail($id_pengurus);
        $pengurus_dkm_data->Jabatan_Pengurus = $request->input('Jabatan_Pengurus');

        // Update the data with new values from the request
        $pengurus_dkm_data->fill($request->all());

        $pengurus_dkm_data->update($request->all());

        if ($request->hasFile('Foto_Pengurus')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Pengurus')->getClientOriginalName();
            $request->file('Foto_Pengurus')->move(public_path('Data_Pengurus/Foto_Pengurus'), $filename1);
            $pengurus_dkm_data->Foto_Pengurus = $filename1;
        }

        if ($request->hasFile('Identitas_Pengurus')) {
            $filename2 = date('Y-m-d') . '_' . $request->file('Identitas_Pengurus')->getClientOriginalName();
            $request->file('Identitas_Pengurus')->move(public_path('Data_Pengurus/Identitas_Pengurus'), $filename2);
            $pengurus_dkm_data->Identitas_Pengurus = $filename2;
        }

        $pengurus_dkm_data->save();


        // Redirect or return response as needed
        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('pengurus_dkm_index')->with('success_edit', 'Data Berhasil Diubah');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//memanggil file pengajar_madrasah_model yg ada di folder Models
use App\Models\pengajar_madrasah_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class pengajar_madrasah_controller extends Controller
{
    // untuk index data uji berfungsi untuk menampilkan data
    public function pengajar_madrasah_index(Request $request)
    {
        /*
        $pengajar_madrasah_data pernyataan variabel
        pengajar_madrasah_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $pengajar_madrasah_data = pengajar_madrasah_model::orderBy('Nama_Pengajar', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $pengajar_madrasah_data = pengajar_madrasah_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Pengajar', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Pengajar', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $pengajar_madrasah_data = pengajar_madrasah_model::orderBy('Nama_Pengajar', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('pengajar_madrasah_data', [
            'pengajar_madrasah_data' => $pengajar_madrasah_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'pengajar_madrasah_data' diambil dari pengajar_madrasah_data.blade.php, compact 'pengajar_madrasah_data', diambil dari variabel $pengajar_madrasah_data
        */
        return view('pengajar_madrasah_data', compact('pengajar_madrasah_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk create dan insert data uji berfungsi untuk memasukan data
    public function pengajar_madrasah_create()
    {

        return view('pengajar_madrasah_create');

    }

    public function pengajar_madrasah_insert(Request $request)
    {
        /**
         * validator berguna utk memeriksa kebutuhan data yang wajib diisi
         * jika data kosong maka akan ada peringatan bahwa data harus diisi
         *
         */
        $validator = Validator::make($request->all(), [
            'Nama_Pengajar' => 'required',
            'Kontak_Pengajar' => 'required',
            'Alamat_Pengajar' => 'required',
            'Status_Pengajar' => 'required',
        ]);

        if ($validator->passes()) {

            $pengajar_madrasah_data = new pengajar_madrasah_model();

            //pengisian model table dengan pengecualian 'updated_by'
            $pengajar_madrasah_data->fill($request->except('updated_by'));

            // mengatur updated email null utk menghindari isi otomatis di fungsi insert
            $pengajar_madrasah_data->updated_by = null;

            //memasukan gambar tanpa storage link

            if ($request->hasFile('Foto_Pengajar')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Pengajar')->getClientOriginalName();
                $request->file('Foto_Pengajar')->move(public_path('Data_Pengajar/Foto_Pengajar'), $filename1);
                $pengajar_madrasah_data->Foto_Pengajar = $filename1;
            }

            if ($request->hasFile('Identitas_Pengajar')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Identitas_Pengajar')->getClientOriginalName();
                $request->file('Identitas_Pengajar')->move(public_path('Data_Pengajar/Identitas_Pengajar'), $filename1);
                $pengajar_madrasah_data->Identitas_Pengajar = $filename1;
            }


            $pengajar_madrasah_data->save();

            return redirect()->route('pengajar_madrasah_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //edit data
    public function pengajar_madrasah_edit($id_pengajar)
    {

        $pengajar_madrasah_data = pengajar_madrasah_model::find($id_pengajar);
        //dd($data_uji);
        return view('pengajar_madrasah_edit', compact('pengajar_madrasah_data'));
    }

    public function pengajar_madrasah_update(Request $request, $id_pengajar)
    {

        //edit gambar tanpa storage link
        // Retrieve the existing data to be updated
        $pengajar_madrasah_data = pengajar_madrasah_model::findOrFail($id_pengajar);

        // Update the data with new values from the request
        $pengajar_madrasah_data->fill($request->all());

        if ($request->hasFile('Foto_Pengajar')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Pengajar')->getClientOriginalName();
            $request->file('Foto_Pengajar')->move(public_path('Data_Pengajar/Foto_Pengajar'), $filename1);
            $pengajar_madrasah_data->Foto_Pengajar = $filename1;
        }

        if ($request->hasFile('Identitas_Pengajar')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Identitas_Pengajar')->getClientOriginalName();
            $request->file('Identitas_Pengajar')->move(public_path('Data_Pengajar/Identitas_Pengajar'), $filename1);
            $pengajar_madrasah_data->Identitas_Pengajar = $filename1;
        }


        $pengajar_madrasah_data->save();

        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('pengajar_madrasah_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //export pdf
    public function pengajar_madrasah_export_pdf()
    {
        $pengajar_madrasah_data = pengajar_madrasah_model::orderBy('Nama_Pengajar', 'asc')->get();

        view()->share('pengajar_madrasah_data', $pengajar_madrasah_data);
        $pdf_pengajar_madrasah = PDF::loadview('pengajar_madrasah_export-pdf');
        return $pdf_pengajar_madrasah->download('pengajar_madrasah.pdf');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //lihat 1 data
    // untuk lihat data uji berfungsi untuk melihat 1 data
    public function pengajar_madrasah_view($id_pengajar)
    {

        $pengajar_madrasah_data = pengajar_madrasah_model::find($id_pengajar);
        return view('pengajar_madrasah_view', compact('pengajar_madrasah_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

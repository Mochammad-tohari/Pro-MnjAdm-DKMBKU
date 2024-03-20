<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//memanggil file murid_madrasah_model yg ada di folder Models
use App\Models\murid_madrasah_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class murid_madrasah_controller extends Controller
{
    // untuk index data uji berfungsi untuk menampilkan data
    public function murid_madrasah_index(Request $request)
    {
        /*
        $murid_madrasah_data pernyataan variabel
        murid_madrasah_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $murid_madrasah_data = murid_madrasah_model::orderBy('Nama_Murid', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $murid_madrasah_data = murid_madrasah_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Murid', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Murid', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $murid_madrasah_data = murid_madrasah_model::orderBy('Nama_Murid', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('murid_madrasah_data', [
            'murid_madrasah_data' => $murid_madrasah_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'murid_madrasah_data' diambil dari murid_madrasah_data.blade.php, compact 'murid_madrasah_data', diambil dari variabel $murid_madrasah_data
        */
        return view('murid_madrasah_data', compact('murid_madrasah_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk create dan insert data uji berfungsi untuk memasukan data
    public function murid_madrasah_create()
    {

        return view('murid_madrasah_create');

    }

    public function murid_madrasah_insert(Request $request)
    {
        /**
         * validator berguna utk memeriksa kebutuhan data yang wajib diisi
         * jika data kosong maka akan ada peringatan bahwa data harus diisi
         *
         */
        $validator = Validator::make($request->all(), [
            'Nama_Murid' => 'required',
            'Tempat_Lahir_Murid' => 'required',
            'Tanggal_Lahir_Murid' => 'required',
            'Asal_Sekolah_Murid' => 'required',
            'Kontak_Murid' => 'required',
            'Alamat_Murid' => 'required',
            'Tingkat_Murid' => 'required',
            'Status_Murid' => 'required',
        ]);

        if ($validator->passes()) {

            $murid_madrasah_data = new murid_madrasah_model();

            //pengisian model table dengan pengecualian 'updated_by'
            $murid_madrasah_data->fill($request->except('updated_by'));

            // mengatur updated email null utk menghindari isi otomatis di fungsi insert
            $murid_madrasah_data->updated_by = null;

            //memasukan gambar tanpa storage link

            if ($request->hasFile('Foto_Murid')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Murid')->getClientOriginalName();
                $request->file('Foto_Murid')->move(public_path('Data_Murid/Foto_Murid'), $filename1);
                $murid_madrasah_data->Foto_Murid = $filename1;
            }

            if ($request->hasFile('Foto_Akta_Kelahiran_Murid')) {
                $filename2 = date('Y-m-d') . '_' . $request->file('Foto_Akta_Kelahiran_Murid')->getClientOriginalName();
                $request->file('Foto_Akta_Kelahiran_Murid')->move(public_path('Data_Murid/Foto_Akta_Kelahiran_Murid'), $filename2);
                $murid_madrasah_data->Foto_Akta_Kelahiran_Murid = $filename2;
            }

            if ($request->hasFile('Foto_KK_Murid')) {
                $filename3 = date('Y-m-d') . '_' . $request->file('Foto_KK_Murid')->getClientOriginalName();
                $request->file('Foto_KK_Murid')->move(public_path('Data_Murid/Foto_KK_Murid'), $filename3);
                $murid_madrasah_data->Foto_KK_Murid = $filename3;
            }

            $murid_madrasah_data->save();

            return redirect()->route('murid_madrasah_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }



    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function murid_madrasah_edit($id_murid)
    {

        $murid_madrasah_data = murid_madrasah_model::find($id_murid);
        //dd($data_uji);
        return view('murid_madrasah_edit', compact('murid_madrasah_data'));
    }

    public function murid_madrasah_update(Request $request, $id_murid)
    {

        //edit gambar tanpa storage link
        // Retrieve the existing data to be updated
        $murid_madrasah_data = murid_madrasah_model::findOrFail($id_murid);

        // Update the data with new values from the request
        $murid_madrasah_data->fill($request->all());

        if ($request->hasFile('Foto_Murid')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Murid')->getClientOriginalName();
            $request->file('Foto_Murid')->move(public_path('Data_Murid/Foto_Murid'), $filename1);
            $murid_madrasah_data->Foto_Murid = $filename1;
        }

        if ($request->hasFile('Foto_Akta_Kelahiran_Murid')) {
            $filename2 = date('Y-m-d') . '_' . $request->file('Foto_Akta_Kelahiran_Murid')->getClientOriginalName();
            $request->file('Foto_Akta_Kelahiran_Murid')->move(public_path('Data_Murid/Foto_Akta_Kelahiran_Murid'), $filename2);
            $murid_madrasah_data->Foto_Akta_Kelahiran_Murid = $filename2;
        }

        if ($request->hasFile('Foto_KK_Murid')) {
            $filename3 = date('Y-m-d') . '_' . $request->file('Foto_KK_Murid')->getClientOriginalName();
            $request->file('Foto_KK_Murid')->move(public_path('Data_Murid/Foto_KK_Murid'), $filename3);
            $murid_madrasah_data->Foto_KK_Murid = $filename3;
        }

        $murid_madrasah_data->save();

        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('murid_madrasah_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function murid_madrasah_export_pdf()
    {
        $murid_madrasah_data = murid_madrasah_model::orderBy('Nama_Murid', 'asc')->get();

        view()->share('murid_madrasah_data', $murid_madrasah_data);
        $pdf_murid_madrasah = PDF::loadview('murid_madrasah_export-pdf');
        return $pdf_murid_madrasah->download('murid_madrasah.pdf');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function show($kode_murid)
    {
        $murid_madrasah_data = murid_madrasah_model::where('Kode_Murid', $kode_murid)->first();

        if ($murid_madrasah_data) {
            return view('murid_madrasah.show', ['murid_madrasah_data' => $murid_madrasah_data]);
        } else {
            return redirect()->route('murid_madrasah_index')->with('error', 'Data not found.');
        }
    }

    // untuk lihat data uji berfungsi untuk melihat 1 data
    public function murid_madrasah_view($id_murid)
    {

        $murid_madrasah_data = murid_madrasah_model::find($id_murid);
        return view('murid_madrasah_view', compact('murid_madrasah_data'));

    }

    // **************************************************************************************************************************/

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk create dan insert data uji berfungsi untuk memasukan data
    public function murid_madrasah_create_public()
    {

        return view('murid_madrasah_create_public');

    }



    public function murid_madrasah_insert_public(Request $request)
    {
        /**
         * Validator berguna untuk memeriksa kebutuhan data yang wajib diisi.
         * Jika data kosong maka akan ada peringatan bahwa data harus diisi.
         */
        $validator = Validator::make($request->all(), [
            'Nama_Murid' => 'required',
            'Tempat_Lahir_Murid' => 'required',
            'Tanggal_Lahir_Murid' => 'required',
            'Asal_Sekolah_Murid' => 'required',
            'Kontak_Murid' => 'required',
            'Alamat_Murid' => 'required',
            'Tingkat_Murid' => 'required',
            'Status_Murid' => 'required',
        ]);

        if ($validator->passes()) {
            $murid_madrasah_data = new murid_madrasah_model();
            $murid_madrasah_data->fill($request->except('updated_by'));
            $murid_madrasah_data->updated_by = null;

            if ($request->hasFile('Foto_Murid')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Murid')->getClientOriginalName();
                $request->file('Foto_Murid')->move(public_path('Data_Murid/Foto_Murid'), $filename1);
                $murid_madrasah_data->Foto_Murid = $filename1;
            }

            if ($request->hasFile('Foto_Akta_Kelahiran_Murid')) {
                $filename2 = date('Y-m-d') . '_' . $request->file('Foto_Akta_Kelahiran_Murid')->getClientOriginalName();
                $request->file('Foto_Akta_Kelahiran_Murid')->move(public_path('Data_Murid/Foto_Akta_Kelahiran_Murid'), $filename2);
                $murid_madrasah_data->Foto_Akta_Kelahiran_Murid = $filename2;
            }

            if ($request->hasFile('Foto_KK_Murid')) {
                $filename3 = date('Y-m-d') . '_' . $request->file('Foto_KK_Murid')->getClientOriginalName();
                $request->file('Foto_KK_Murid')->move(public_path('Data_Murid/Foto_KK_Murid'), $filename3);
                $murid_madrasah_data->Foto_KK_Murid = $filename3;
            }

            $murid_madrasah_data->save();

            // After saving data, get the saved murid_madrasah_data
            $savedMurid = murid_madrasah_model::orderBy('created_at', 'desc')->first();

            // Redirect to the view with necessary variables
            return view('Murid_Madrasah_Pendaftaran_Selesai', [
                'Kode_Murid' => $savedMurid->Kode_Murid,
                'Nama_Murid' => $savedMurid->Nama_Murid
            ]);
        }

    }

    public function pendaftaran_murid_selesai(Request $request)
    {
        // Retrieve success message and data from the session
        $successMessage = $request->session()->get('success');
        $kodeMurid = $request->session()->get('Kode_Murid');
        $namaMurid = $request->session()->get('Nama_Murid');

        // Pass the success message and data to the view
        return view('murid_madrasah_pendaftaran_selesai', compact('successMessage', 'kodeMurid', 'namaMurid'));
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}

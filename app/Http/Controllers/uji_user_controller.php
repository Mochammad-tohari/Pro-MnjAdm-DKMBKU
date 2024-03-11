<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import hash untuk field password
use Illuminate\Support\Facades\Hash;

/* import Model "uji_bidang_model" dari folder models
diimport karena di tabel/model ini merupakan tabel yang memiliki field,
yang bergantung dengan suatu field di table uji_bidang */
use App\Models\uji_bidang_model;

//import Model "uji_user_model" dari folder models
use App\Models\uji_user_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import method import Excel
use Maatwebsite\Excel\Facades\Excel;

/*
import method export Excel sesuaikan dengan nama fungsi dan file di folder export contoh
uji_user_excel_export
*/
use App\Exports\uji_user_excel_export;

/*
import method import Excel sesuaikan dengan nama fungsi dan file di folder import contoh
uji_user_excel_import
*/
use App\Imports\uji_user_excel_import;

//import class Session
use Illuminate\Support\Facades\Session;

class uji_user_controller extends Controller
{
    // untuk index data uji berfungsi untuk menampilkan data
    public function uji_user_index_new(Request $request)
    {
        /*
        $uji_user_data pernyataan variabel
        uji_user_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $uji_user_data = uji_user_model::orderBy('Nama_Uji_User', 'asc')
            ->paginate(5);

        /*
            syntax search data berdasarkan Nama_Uji_User, Kode_Uji_User
        */
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $uji_user_data = uji_user_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Uji_User', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Uji_User', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $uji_user_data = uji_user_model::orderBy('Nama_Uji_User', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('uji_user_data_new', [
            'uji_user_data_new' => $uji_user_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'uji_user_data_new' diambil dari uji_user_data_new.blade.php, compact 'uji_user_data_new', diambil dari variabel $uji_user_data
        */
        return view('uji_user_data_new', compact('uji_user_data_new'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //create dan insert data
    public function uji_user_create()
    {

        /**
         * $Uji_Bidang_Options
         * import uji_bidang_model di folder models dari tabel uji bidang
         * uji_bidang_model::pluck('Nama_Bidang', 'Kode_Bidang'); = mengambil nama Nama_Bidang berdasarkan kode Kode_Bidang yang ada di table uji_bidang
         */
        $Uji_Bidang_Options = uji_bidang_model::pluck('Nama_Bidang', 'Kode_Bidang');

        /**
         * uji_user_create berasal dari uji_user_create.blade.php
         */
        return view('uji_user_create', compact('Uji_Bidang_Options'));
    }

    public function uji_user_insert(Request $request)
    {

        /**
         * validator berguna utk memeriksa kebutuhan data yang wajib diisi
         * serta menentukan kondisi tertentu contohnya field 'Password_Uji_User' => 'required|min:5'
         * jika data kosong maka akan ada peringatan bahwa data harus diisi
         *
         */
        $validator = Validator::make($request->all(), [
            // 'Jabatan_Uji_User' => 'required',
            'Nama_Uji_User' => 'required',
            'Password_Uji_User' => 'required|min:5',
            'Tanggal_Uji_User' => 'required',
            'Status_Uji_User' => 'required',
        ], [
            'Password_Uji_User.required' => 'The Password field is required.',
            'Password_Uji_User.min' => 'Password minimal memiliki :min karakter',
        ]);


        /**
         * jika validasi berhasil maka data akan disimpan
         */
        if ($validator->passes()) {

            // Create a new instance of pengurus_dkm_model
            $uji_user_data = new uji_user_model();

            // Fill the model with form data (excluding updated_by)
            $uji_user_data->fill($request->except(['updated_by']));

            // Set the updated_by field to null initially
            $uji_user_data->updated_by = null;

            // Assign the input 'Jabatan_Uji_User' value to the 'Jabatan_Uji_User' property
            $uji_user_data->Jabatan_Uji_User = $request->input('Jabatan_Uji_User');

            /**
             * mengatur field Password_Uji_User supaya terenkripsi di database
             * jadi teks passowrd aslinya disamarkan
             */
            $encryptedPassword = Hash::make($request->input('Password_Uji_User'));
            // Assign the encrypted password to the 'Password_Uji_User' property
            $uji_user_data->Password_Uji_User = $encryptedPassword;

            // Check if 'Foto_Profil' file is present in the request
            /*
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Profil')->getClientOriginalName();
            memberikan nama foto sesuai dengan nama file dan menambahkan nama tanggal pada file yang diminta

            $request->file('Foto_Profil')->move(public_path('Data_Uji_User/Foto_Profil'), $filename1);
            menyimpan file foto di folder public->Data_Uji_User->Foto_Profil
             */
            if ($request->hasFile('Foto_Profil')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Profil')->getClientOriginalName();
                $request->file('Foto_Profil')->move(public_path('Data_Uji_User/Foto_Profil'), $filename1);
                $uji_user_data->Foto_Profil = $filename1;
            }

            // Check if 'Foto_Identitas' file is present in the request
            if ($request->hasFile('Foto_Identitas')) {
                $filename2 = date('Y-m-d') . '_' . $request->file('Foto_Identitas')->getClientOriginalName();
                $request->file('Foto_Identitas')->move(public_path('Data_Uji_User/Foto_Identitas'), $filename2);
                $uji_user_data->Foto_Identitas = $filename2;
            }

            // Save the updated files
            $uji_user_data->save();

            /**
             * setelah data disimpan maka akan dialihkan ke halaman uji_user_data_new.blade.php
             * dengan notofikasi 'success', 'Data Berhasil Dimasukan'
             */
            return redirect()->route('uji_user_index_new')->with('success', 'Data Berhasil Dimasukan');

        } else {


            /**
             * validasi belum terpenuhi maka akan dikirim ke halaman tambah data
             * dengan mengisi kolom yang kurang
             */
            return redirect()->back()->withErrors($validator)->withInput();

        }


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //fungsi edit dan update
    public function uji_user_edit($id_uji_user)
    {
        /**
         * $id_uji_user mencari databerdasarkan id_uji_user di tabel uji_user
         * id_uji_user menjadi parameter atau acuan dalam pangambilan data
         * uji_user_model berasal dari folder models dari table uji_user
         */
        $uji_user_data = uji_user_model::findOrFail($id_uji_user);

        /**
         * $Uji_Bidang_Options
         * import uji_bidang_model di folder models dari tabel uji bidang
         * uji_bidang_model::pluck('Nama_Bidang', 'Kode_Bidang'); = mengambil nama Nama_Bidang berdasarkan kode Kode_Bidang yang ada di table uji_bidang
         */
        $Uji_Bidang_Options = uji_bidang_model::pluck('Nama_Bidang', 'Kode_Bidang');

        /**
         * memuat halaman uji_user_edit.blade.php
         *
         *  compact('uji_user_data', 'Uji_Bidang_Options'))
         * memuat variabel $uji_user_data untuk memanggil data berdasarkan id_uji_user
         *
         * Uji_Bidang_Options
         * memuat variable $Uji_Bidang_Options untuk mengambil bidang yang ada
         * diambil dari tabel uji_bidang
         */
        return view('uji_user_edit', compact('uji_user_data', 'Uji_Bidang_Options'));
    }


    public function uji_user_update(Request $request, $id_uji_user)
    {
        /**
         * $id_uji_user mencari databerdasarkan id_uji_user di tabel uji_user
         * id_uji_user menjadi parameter atau acuan dalam pangambilan data
         */
        $uji_user_data = uji_user_model::findOrFail($id_uji_user);

        /**
         * meminta field Jabatan_Uji_User utk diisi
         */
        $uji_user_data->Jabatan_Uji_User = $request->input('Jabatan_Uji_User');

        /**
         * fill dan update berfungsi sebagai perintah isi dan mempebaharui data
         */
        $uji_user_data->fill($request->all());
        $uji_user_data->update($request->all());

        /*
           $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Profil')->getClientOriginalName();
           memberikan nama foto sesuai dengan nama file dan menambahkan nama tanggal pada file yang diminta

           $request->file('Foto_Profil')->move(public_path('Data_Uji_User/Foto_Profil'), $filename1);
           menyimpan file foto di folder public->Data_Uji_User->Foto_Profil
        */
        if ($request->hasFile('Foto_Profil')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Foto_Profil')->getClientOriginalName();
            $request->file('Foto_Profil')->move(public_path('Data_Uji_User/Foto_Profil'), $filename1);
            $uji_user_data->Foto_Profil = $filename1;
        }


        if ($request->hasFile('Foto_Identitas')) {
            $filename2 = date('Y-m-d') . '_' . $request->file('Foto_Identitas')->getClientOriginalName();
            $request->file('Foto_Identitas')->move(public_path('Data_Uji_User/Foto_Identitas'), $filename2);
            $uji_user_data->Foto_Identitas = $filename2;
        }

        $uji_user_data->save();


        // Redirect or return response as needed
        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        /**
         * memuat halaman uji_user_data_new.blade.php
         *
         * uji_user_index_new varabel dari fungsi uji_user_index_new
         * memberikan notifikasi 'success_edit', 'Data Berhasil Diubah'
         */
        return redirect()->route('uji_user_index_new')->with('success_edit', 'Data Berhasil Diubah');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk delete data uji berfungsi untuk menghapus data
    public function uji_user_delete($id_uji_user)
    {
        /**
         * $id_uji_user mencari databerdasarkan id_uji_user di tabel uji_user
         * id_uji_user menjadi parameter atau acuan dalam pangambilan data
         * uji_user_model berasal dari folder models dari table uji_user
         */
        $uji_user_data = uji_user_model::find($id_uji_user);

        /**
         * jika data tidak ada maka akan ada notifikasi data tidak ditemukan
         */
        if (!$uji_user_data) {
            // Data not found, return an error response or redirect back with an error message
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        /**
         * jika data ditemakan maka data akan dihapus
         */
        $uji_user_data->delete();


        /**
         * memuat halaman uji_user_data_new.blade.php
         *
         * uji_user_index_new varabel dari fungsi uji_user_index_new
         * memberikan notifikasi 'success_delete', 'Data Berhasil Dihapus'
         */
        return redirect()->route('uji_user_index_new')->with('success_delete', 'Data Berhasil Dihapus');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //export PDF
    public function uji_user_export_pdf()
    {

        /**
         * uji_user_model berasal dari folder model dari tabel uji_user
         * orderBy('Nama_Uji_User', 'asc')
         * mengurutkan data berdasarkan Nama_Uji_User ascending
         */
        $uji_user_data = uji_user_model::orderBy('Nama_Uji_User', 'asc')->get();

        /**
         * uji_user_export-pdf berasal dari uji_user_export-pdf.blade.php
         * memuat tabel yang ada di uji_user_export-pdf.blade.php
         */
        view()->share('uji_user_data', $uji_user_data);
        $uji_user_pdf = PDF::loadview('uji_user_export-pdf');

        /**
         * mengunduh file pdf dengan nama data_uji_user.pdf
         */
        return $uji_user_pdf->download('data_uji_user.pdf');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function show($kode_uji_user)
    {
        $uji_user_data = uji_user_model::where('Kode_Uji_User', $kode_uji_user)->first();

        if ($uji_user_data) {
            return view('uji_user.show', ['uji_user_data' => $uji_user_data]);
        } else {
            return redirect()->route('uji_user_index_new')->with('error', 'Data not found.');
        }
    }

    // untuk lihat data uji berfungsi untuk melihat 1 data
    public function uji_user_view($id_uji_user)
    {

        /**
         * menampilkan halaman uji_user_view.blade.php
         * mencari data berdasarkan id_uji_user
         */
        $uji_user_data = uji_user_model::find($id_uji_user);
        return view('uji_user_view', compact('uji_user_data'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk export_excel_uji berfungsi untuk mengesport data ke file excel
    public function uji_user_excel_export()
    {
        /**
         * uji_user_excel_export berasal dari uji_user_excel_export.php
         * mendownload file dengan nama 'uji_user.xlsx'
         * \Maatwebsite\Excel\Excel -> class excel
         */
        return Excel::download(new uji_user_excel_export, 'uji_user.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }


    // untuk uji_user_excel_import berfungsi untuk import file excel
    public function uji_user_excel_import(Request $request)
    {
        /**
         * meminta file masukan bernama file_uji_user
         * pada saat import file excel
         * (nama file excel tidak wajib file_uji_user bisa nama yang lain, file_uji_user hanya sebagai parameter saja)
         */
        $uji_user_data = $request->file('file_uji_user');

        /**
         * $filename = $uji_user_data->getClientOriginalName();
         * mengambil file excel berdasarkan nama bawaan file excel
         *
         *  $uji_user_data->move('Uji_User_Data_Excel_Import', $filename);
         * dan memindahkanya ke folder Uji_User_Data_Excel_Import
         */
        $filename = $uji_user_data->getClientOriginalName();
        $uji_user_data->move('Uji_User_Data_Excel_Import', $filename);
        Excel::import(new uji_user_excel_import, \public_path('/Uji_User_Data_Excel_Import/' . $filename));

        /**
         * redirect()->back();
         * kembali ke halaman tampilan indeks data
         */
        return \redirect()->back();


    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import hash untuk field password
use Illuminate\Support\Facades\Hash;

//import Model "uji_bidang_model" dari folder models
use App\Models\uji_bidang_model;

//import Model "uji_user_model" dari folder models
use App\Models\uji_user_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import method export Excel
use App\Exports\export_excel_uji;

//import method export Excel di folder Exports
use App\Imports\uji_excel_import;

//import method import Excel di folder Imports
use Maatwebsite\Excel\Facades\Excel;

//import class Session
use Illuminate\Support\Facades\Session;

class uji_user_controller extends Controller
{
    // untuk index data uji berfungsi untuk menampilkan data
    public function uji_user_index(Request $request)
    {
        /*
        $uji_user_data pernyataan variabel
        uji_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $uji_user_data = uji_user_model::orderBy('Nama_Uji_User', 'asc')
            ->paginate(5);

        //syntax search data
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

        return view('uji_user_data', [
            'uji_user_data' => $uji_user_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'uji_user_data' diambil dari uji_user_data.blade.php, compact 'uji_user_data', diambil dari variabel $uji_user_data
        */
        return view('uji_user_data', compact('uji_user_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //create dan insert data
    public function uji_user_create()
    {

        // $Uji_Bidang_Options
        // uji_bidang_model::pluck('Jabatan_Uji_User', 'Kode_Bidang'); = mengambil nama Nama_Bidang berdasarkan kode Kode_Bidang yang ada di table uji_bidang
        $Uji_Bidang_Options = uji_bidang_model::pluck('Nama_Bidang', 'Kode_Bidang');

        return view('uji_user_create', compact('Uji_Bidang_Options'));
    }

    public function uji_user_insert(Request $request)
    {

        //validator berfungsi mengecek isian form yang harus di isi terkadang memiliki beberapa kondisi seperti pada "Password"
        $validator = Validator::make($request->all(), [
            'Jabatan_Uji_User' => 'required',
            'Nama_Uji_User' => 'required',
            'Password_Uji_User' => 'required|min:5',
            'Tanggal_Uji_User' => 'required',
            'Status_Uji_User' => 'required',
        ], [
            'Password_Uji_User.required' => 'The Password field is required.',
            'Password_Uji_User.min' => 'Password minimal memiliki :min karakter',
        ]);

        if ($validator->passes()) {

            // Create a new instance of pengurus_dkm_model
            $uji_user_data = new uji_user_model();

            // Fill the model with form data (excluding updated_by)
            $uji_user_data->fill($request->except(['updated_by']));

            // Set the updated_by field to null initially
            $uji_user_data->updated_by = null;

            // Assign the input 'Jabatan_Uji_User' value to the 'Jabatan_Uji_User' property
            $uji_user_data->Jabatan_Uji_User = $request->input('Jabatan_Uji_User');

            // Encrypt the password using bcrypt
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

            return redirect()->route('uji_user_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //fungsi edit dan update
    public function uji_user_edit($id_uji_user)
    {
        //dd($id_uji_user);

        // $bidang_pengurus_option
        $uji_user_data = uji_user_model::findOrFail($id_uji_user);

        // uji_bidang_model::pluck('Jabatan_Uji_User', 'Kode_Bidang'); = mengambil nama Nama_Bidang berdasarkan kode Kode_Bidang yang ada di table uji_bidang
        $Uji_Bidang_Options = uji_bidang_model::pluck('Nama_Bidang', 'Kode_Bidang');

        return view('uji_user_edit', compact('uji_user_data', 'Uji_Bidang_Options'));
    }


    public function uji_user_update(Request $request, $id_uji_user)
    {
        $uji_user_data = uji_user_model::findOrFail($id_uji_user);
        $uji_user_data->Jabatan_Uji_User = $request->input('Jabatan_Uji_User');

        // Update the data with new values from the request
        $uji_user_data->fill($request->all());

        $uji_user_data->update($request->all());

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

        return redirect()->route('uji_user_index')->with('success_edit', 'Data Berhasil Diubah');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "majlistalim_model" dari folder models
use App\Models\majlistalim_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class majlistalim_controller extends Controller
{
    public function majlistalim_index(Request $request)
    {
        /*
        $majlistalim_data pernyataan variabel
        majlistalim_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $majlistalim_data = majlistalim_model::orderBy('Nama_Majlistalim', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $majlistalim_data = majlistalim_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Majlistalim', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Majlistalim', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $majlistalim_data = majlistalim_model::orderBy('Nama_Majlistalim', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('majlistalim_data', [
            'majlistalim_data' => $majlistalim_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'majlistalim_data' diambil dari majlistalim_data.blade.php, compact 'majlistalim_data', diambil dari variabel $majlistalim_data
        */
        return view('majlistalim_data', compact('majlistalim_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function majlistalim_create()
    {

        return view('majlistalim_create');

    }

    public function majlistalim_insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Nama_Majlistalim' => 'required',
            'Kontak_Majlistalim' => 'required',
            'Status_Majlistalim' => 'required',
        ]);

        if ($validator->passes()) {
            //dd($request->all());
            // Create a new instance of majlistalim
            $majlistalim_data = new majlistalim_model();
            //pengisian model table dengan pengecualian 'updated_by'
            $majlistalim_data->fill($request->except('updated_by'));

            // mengatur updated email utk menghindari isi otomatis di fungsi insert
            $majlistalim_data->updated_by = null;

            if ($request->hasFile('Logo_Majlistalim')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Logo_Majlistalim')->getClientOriginalName();
                $request->file('Logo_Majlistalim')->move(public_path('Data_Majlistalim/Logo_Majlistalim'), $filename1);
                $majlistalim_data->Logo_Majlistalim = $filename1;
            }


            $majlistalim_data->save();

            return redirect()->route('majlistalim_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function majlistalim_edit($id_majlistalim)
    {

        $majlistalim_data = majlistalim_model::find($id_majlistalim);

        return view('majlistalim_edit', compact('majlistalim_data'));
    }

    public function majlistalim_update(Request $request, $id_majlistalim)
    {

        $majlistalim_data = majlistalim_model::findOrFail($id_majlistalim); // Assuming you have the ID of the row you want to update

        $majlistalim_data->update($request->all());

        if ($request->hasFile('Logo_Majlistalim')) {
            $filename1 = date('Y-m-d') . '_' . $request->file('Logo_Majlistalim')->getClientOriginalName();
            $request->file('Logo_Majlistalim')->move(public_path('Data_Majlistalim/Logo_Majlistalim'), $filename1);
            $majlistalim_data->Logo_Majlistalim = $filename1;
        }

        $majlistalim_data->save();

        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('majlistalim_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function majlistalim_export_pdf()
    {
        $majlistalim_data = majlistalim_model::orderBy('Nama_Majlistalim', 'asc')->get();

        view()->share('majlistalim_data', $majlistalim_data);
        $majlistalim_pdf = PDF::loadview('majlistalim_export-pdf');
        return $majlistalim_pdf->download('data_majlistalim.pdf');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk lihat data majlistalim berfungsi untuk melihat 1 data
    public function majlistalim_view($id_majlistalim)
    {

        $majlistalim_data = majlistalim_model::find($id_majlistalim);
        return view('majlistalim_view', compact('majlistalim_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // **************************************************************************************************************************/

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * insert data untuk public (bisa diakses tanpa login/akun)
     */

    // untuk create dan insert data uji berfungsi untuk memasukan data
    public function majlistalim_create_public()
    {

        return view('majlistalim_create_public');

    }



    public function majlistalim_insert_public(Request $request)
    {
        /**
         * Validator berguna untuk memeriksa kebutuhan data yang wajib diisi.
         * Jika data kosong maka akan ada peringatan bahwa data harus diisi.
         */
        $validator = Validator::make($request->all(), [
            'Nama_Majlistalim' => 'required',
            'Kontak_Majlistalim' => 'required',
            'Status_Majlistalim' => 'required',
        ]);

        if ($validator->passes()) {
            //dd($request->all());
            // Create a new instance of majlistalim
            $majlistalim_data = new majlistalim_model();
            //pengisian model table dengan pengecualian 'updated_by'
            $majlistalim_data->fill($request->except('updated_by'));

            // mengatur updated email utk menghindari isi otomatis di fungsi insert
            $majlistalim_data->updated_by = null;

            if ($request->hasFile('Logo_Majlistalim')) {
                $filename1 = date('Y-m-d') . '_' . $request->file('Logo_Majlistalim')->getClientOriginalName();
                $request->file('Logo_Majlistalim')->move(public_path('Data_Majlistalim/Logo_Majlistalim'), $filename1);
                $majlistalim_data->Logo_Majlistalim = $filename1;
            }


            $majlistalim_data->save();

            // After saving data, get the saved majlistalim_data
            $majlistalim_save = majlistalim_model::orderBy('created_at', 'desc')->first();

            // Redirect to the view with necessary variables
            return redirect()->route('pendaftaran_majlistalim_selesai')->with([
                'success' => 'Data Berhasil Dimasukan',
                'Kode_Majlistalim' => $majlistalim_save->Kode_Majlistalim,
                'Nama_Majlistalim' => $majlistalim_save->Nama_Majlistalim
            ]);
        } else {

            /**
             * validasi belum terpenuhi maka akan dikirim ke halaman tambah data
             * dengan mengisi kolom yang kurang
             */
            return redirect()->back()->withErrors($validator)->withInput();

        }

    }

    public function pendaftaran_majlistalim_selesai(Request $request)
    {
        // Retrieve success message and data from the session
        $successMessage = $request->session()->get('success');
        $Kode_Majlistalim = $request->session()->get('Kode_Majlistalim');
        $Nama_Majlistalim = $request->session()->get('Nama_Majlistalim');

        // Pass the success message and data to the view
        return view('majlistalim_pendaftaran_selesai', compact('successMessage', 'Kode_Majlistalim', 'Nama_Majlistalim'));


    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}

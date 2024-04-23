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



}

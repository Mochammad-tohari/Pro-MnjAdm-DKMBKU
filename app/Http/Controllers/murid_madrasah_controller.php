<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $data_uji pernyataan variabel
        uji_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $murid_madrasah_data = murid_madrasah_model::orderBy('Nama_Murid', 'asc')
                                -> paginate(5);

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
        view 'data_uji' diambil dari data_uji.blade.php, compact 'data_uji', diambil dari variabel $data_uji
        */
        return view('murid_madrasah_data',compact ('murid_madrasah_data'));

    }

    // untuk create dan insert data uji berfungsi untuk memasukan data
    public function murid_madrasah_create()
    {

        return view('murid_madrasah_create');

    }

    public function murid_madrasah_insert(Request $request)
    {
        //memasukan gambar tanpa storage link
        $murid_madrasah_data = murid_madrasah_model::create($request->all());

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

    }

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

        if(session('page_url')){
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('murid_madrasah_index')->with('success_edit', 'Data Berhasil Diubah');


    }


    public function murid_madrasah_export_pdf()
    {
        $murid_madrasah_data = murid_madrasah_model::orderBy('Nama_Murid', 'asc')->get();

        view()->share('murid_madrasah_data', $murid_madrasah_data);
        $pdf_murid_madrasah = PDF::loadview('murid_madrasah_export-pdf');
        return $pdf_murid_madrasah->download('murid_madrasah.pdf');


    }



}

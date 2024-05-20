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

}

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

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "bidang_nawa_model" dari folder models
use App\Models\bidang_nawa_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class bidang_nawa_controller extends Controller
{
    public function bidang_nawa_index(Request $request)
    {
        /*
        $bidang_nawa_data pernyataan variabel
        bidang_nawa_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $bidang_nawa_data = bidang_nawa_model::orderBy('Nama_Bidang_Nawa', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $bidang_nawa_data = bidang_nawa_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Bidang_Nawa', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Bidang_Nawa', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $bidang_nawa_data = bidang_nawa_model::orderBy('Nama_Bidang_Nawa', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('bidang_nawa_data', [
            'bidang_nawa_data' => $bidang_nawa_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'bidang_nawa_data' diambil dari bidang_nawa_data.blade.php, compact 'bidang_nawa_data', diambil dari variabel $bidang_nawa_data
        */
        return view('bidang_nawa_data', compact('bidang_nawa_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

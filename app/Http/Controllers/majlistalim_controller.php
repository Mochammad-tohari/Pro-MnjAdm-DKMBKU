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

}

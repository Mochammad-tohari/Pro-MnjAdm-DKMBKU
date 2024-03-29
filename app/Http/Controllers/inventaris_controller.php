<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "inventaris_model" dari folder models
use App\Models\inventaris_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import class Session
use Illuminate\Support\Facades\Session;

class inventaris_controller extends Controller
{
    public function inventaris_index(Request $request)
    {
        /*
        $inventaris_data pernyataan variabel
        inventaris_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $inventaris_data = inventaris_model::orderBy('Nama_Inventaris', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $inventaris_data = inventaris_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Inventaris', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Inventaris', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $inventaris_data = inventaris_model::orderBy('Nama_Inventaris', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('inventaris_data', [
            'inventaris_data' => $inventaris_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'inventaris_data' diambil dari inventaris_data.blade.php, compact 'inventaris_data', diambil dari variabel $inventaris_data
        */
        return view('inventaris_data', compact('inventaris_data'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

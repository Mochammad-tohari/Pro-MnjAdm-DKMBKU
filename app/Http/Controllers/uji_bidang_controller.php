<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import validator
use Illuminate\Support\Facades\Validator;

//import Model "uji_bidang_model" dari folder models
use App\Models\uji_bidang_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use PDF;

//import method export Excel sesuaikan nama fungsinya contoh "uji_bidang_export_excel"
use App\Exports\uji_bidang_export_excel;

//import method export Excel di folder Exports sesuaikan nama fungsinya contoh "uji_bidang_import_excel"
use App\Imports\uji_bidang_import_excel;

//import method import Excel di folder Imports
use Maatwebsite\Excel\Facades\Excel;

//import class Session
use Illuminate\Support\Facades\Session;

class uji_bidang_controller extends Controller
{
    // untuk index data uji_bidang berfungsi untuk menampilkan data
    public function uji_bidang_index_new(Request $request)
    {
        /*
        $uji_bidang_data pernyataan variabel
        uji_bidang_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil
        */
        $uji_bidang_data = uji_bidang_model::orderBy('Nama_Bidang', 'asc')
            ->paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $uji_bidang_data = uji_bidang_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama_Bidang', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('Kode_Bidang', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
            Session::put('page_url', request()->fullUrl());
        } else {
            $uji_bidang_data = uji_bidang_model::orderBy('Nama_Bidang', 'asc')->paginate(5);
            Session::put('page_url', request()->fullUrl());
        }

        return view('uji_bidang_data_new', [
            'uji_bidang_data_new' => $uji_bidang_data,
            'searchQuery' => $searchQuery,
        ]);

        /*
        view 'uji_bidang_data_new' diambil dari uji_bidang_data_new.blade.php, compact 'uji_bidang_data_new', diambil dari variabel $data_uji_bidang
        */
        return view('uji_bidang_data_new', compact('uji_bidang_data_new'));

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk create dan insert data
    public function uji_bidang_create()
    {

        // Fetch the uji_bidang_data from your database or any other source
        $uji_bidang_data = uji_bidang_model::all(); // Replace YourModel with the actual model name

        // Pass the $uji_bidang_data variable to the view
        return view('uji_bidang_create', ['uji_bidang_data' => $uji_bidang_data]);

    }

    public function uji_bidang_insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Nama_Bidang' => 'required',
            'Status_Bidang' => 'required',
        ]);

        if ($validator->passes()) {
            //dd($request->all());
            // Create a new instance of uji_bidang
            $uji_bidang_data = new uji_bidang_model();
            //pengisian model table dengan pengecualian 'updated_by'
            $uji_bidang_data->fill($request->except('updated_by'));

            // mengatur updated email utk menghindari isi otomatis di fungsi insert
            $uji_bidang_data->updated_by = null;

            $uji_bidang_data = uji_bidang_model::create($request->all());
            $uji_bidang_data->save();

            return redirect()->route('uji_bidang_index')->with('success', 'Data Berhasil Dimasukan');

        } else {

            // Validation failed, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();

        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk edit dan update data uji berfungsi untuk mengubah data
    public function uji_bidang_edit($id_uji_bidang)
    {

        $uji_bidang_data = uji_bidang_model::find($id_uji_bidang);
        //dd($data_uji);
        return view('uji_bidang_edit', compact('uji_bidang_data'));
    }


    public function uji_bidang_update(Request $request, $id_uji_bidang)
    {

        $uji_bidang_data = uji_bidang_model::findOrFail($id_uji_bidang); // Assuming you have the ID of the row you want to update

        $uji_bidang_data->update($request->all());

        $uji_bidang_data->save();

        if (session('page_url')) {
            return redirect(session('page_url'))->with('success_edit', 'Data Berhasil Diubah');
        }

        return redirect()->route('uji_bidang_index')->with('success_edit', 'Data Berhasil Diubah');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // untuk delete data uji berfungsi untuk menghapus data
    public function uji_bidang_delete($id_uji_bidang)
    {
        // Find the uji bidang data by ID
        $uji_bidang_data = uji_bidang_model::find($id_uji_bidang);

        // Check if the data exists
        if (!$uji_bidang_data) {
            // Data not found, return an error response or redirect back with an error message
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Data found, proceed with deletion
        $uji_bidang_data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('uji_bidang_index_new')->with('success_delete', 'Data Berhasil Dihapus');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //export PDF
    public function uji_bidang_export_pdf()
    {
        $uji_bidang_data = uji_bidang_model::orderBy('Nama_Bidang', 'asc')->get();

        view()->share('uji_bidang_data', $uji_bidang_data);
        $uji_bidang_pdf = PDF::loadview('uji_bidang_export-pdf');
        return $uji_bidang_pdf->download('data_uji_bidang.pdf');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk export_excel_uji berfungsi untuk mengesport data ke file excel
    public function uji_bidang_export_excel()
    {

        return Excel::download(new uji_bidang_export_excel, 'uji_bidang.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }


    // untuk uji_bidang_import_excel berfungsi untuk import file excel
    public function uji_bidang_import_excel(Request $request)
    {

        $uji_bidang_data = $request->file('file_uji_bidang');

        $filename = $uji_bidang_data->getClientOriginalName();
        $uji_bidang_data->move('Uji_Bidang_Data', $filename);

        Excel::import(new uji_bidang_import_excel, \public_path('/Uji_Bidang_Data/' . $filename));
        return \redirect()->back();


    }

}

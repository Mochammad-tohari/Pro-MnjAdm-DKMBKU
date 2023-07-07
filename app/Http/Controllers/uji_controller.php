<?php

namespace App\Http\Controllers;

use PDF;

//import Model "uji_model" dari folder models
use App\Models\uji_model;

//return type View
use Illuminate\View\View;

//import method export PDF
use Illuminate\Http\Request;

//import method export Excel
use Maatwebsite\Excel\Facades\Excel;

//import method export Excel di folder Exports
use App\Exports\export_excel_uji;


class uji_controller extends Controller
{

// untuk index data uji berfungsi untuk menampilkan data    
    public function index_uji(Request $request) 
    {
        /* 
        $data_uji pernyataan variabel 
        uji_model diambil dari folder model
        latest()->paginate(5); membatasi 5 data baru yang tampil 
        */
        $data_uji = uji_model::orderBy('Nama', 'asc')
                                -> paginate(5);

        //syntax search data
        $searchQuery = $request->input('search');

        if ($request->has('search')) {
            $data_uji = uji_model::where(function ($query) use ($searchQuery) {
                $query->where('Nama', 'LIKE', '%' . $searchQuery . '%')
                      ->orWhere('Kode', 'LIKE', '%' . $searchQuery . '%');
            })->paginate(5);
        } else {
            $data_uji = uji_model::orderBy('Nama', 'asc')->paginate(5);
        }
    
        return view('data_uji', [
            'data_uji' => $data_uji,
            'searchQuery' => $searchQuery,
        ]);
                                
 /* 
 compact ('data_uji', diambil dari variabel $data_uji
*/
        return view('data_uji',compact ('data_uji'));
        
    }

// untuk create dan insert data uji berfungsi untuk memasukan data
    public function create_data_uji()
    {

        return view('create_data_uji');

    }

    public function insert_data_uji(Request $request)
    {
        //dd($request->all());

                //syntax dari if dan dilamnya berguna untuk memeriksa dan mengambil file foto untuk disimpan
                $filename1 = null;
                $filename2 = null;

                if ($request->hasFile('Foto1')) {
                    $foto1 = $request->file('Foto1');
                    $filename1 = date('Y-m-d') . '_' . $foto1->getClientOriginalName();
                    $foto1->storeAs('public/folder_foto1', $filename1);
                }

                if ($request->hasFile('Foto2')) {
                    $foto2 = $request->file('Foto2');
                    $filename2 = date('Y-m-d') . '_' . $foto2->getClientOriginalName();
                    $foto2->storeAs('public/folder_foto2', $filename2);
                }

                $data_uji = uji_model::create($request->all());

                $data_uji->foto1 = $filename1;
                $data_uji->foto2 = $filename2;
                $data_uji->save();

                return redirect()->route('index_uji')->with('success', 'Data Berhasil Dimasukan');
        
    }    
// untuk delete data uji berfungsi untuk menghapus data
    public function delete_data_uji($id)
    {

        $data_uji = uji_model::find($id);
        $data_uji->delete();
        return redirect()->route('index_uji')->with('success_delete','Data Berhasil Dihapus');
    }


// untuk edit dan update data uji berfungsi untuk mengubah data
    public function edit_data_uji($id)
    {

        $data_uji = uji_model::find($id);
        //dd($data_uji);
        return view('edit_data_uji', compact('data_uji'));
    }

    public function update_data_uji(Request $request, $id)
    {

        $filename1 = null;
        $filename2 = null;

        if ($request->hasFile('Foto1')) {
            $foto1 = $request->file('Foto1');
            $filename1 = date('Y-m-d') . '_' . $foto1->getClientOriginalName();
            $foto1->storeAs('public/folder_foto1', $filename1);
        }

        if ($request->hasFile('Foto2')) {
            $foto2 = $request->file('Foto2');
            $filename2 = date('Y-m-d') . '_' . $foto2->getClientOriginalName();
            $foto2->storeAs('public/folder_foto2', $filename2);
        }

        $data_uji = uji_model::findOrFail($id); // Assuming you have the ID of the row you want to update

        $data_uji->update($request->all());

        if ($filename1) {
            $data_uji->foto1 = $filename1;
        }

        if ($filename2) {
            $data_uji->foto2 = $filename2;
        }

        $data_uji->save();

        return redirect()->route('index_uji')->with('success', 'Data Berhasil Diperbarui');


    }

// untuk lihat data uji berfungsi untuk melihat 1 data
    public function lihat_data_uji($id)
    {

    $data_uji = uji_model::find($id);
    return view('lihat_data_uji', compact('data_uji'));
    
    }

// untuk export_pdf_uji data uji berfungsi untuk mengesport data ke file PDF
    public function export_pdf_uji() 
    {
        $data_uji = uji_model::orderBy('Nama', 'asc')->get();
        
        view()->share('data_uji', $data_uji);
        $pdf_uji = PDF::loadview('export_uji-pdf');
        return $pdf_uji->download('data_uji.pdf');

        
    }

// untuk export_pdf_uji data uji berfungsi untuk mengesport data ke file PDF
    public function export_excel_uji() 
    {

        return Excel::download(new export_excel_uji, 'data_uji.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }

    

}

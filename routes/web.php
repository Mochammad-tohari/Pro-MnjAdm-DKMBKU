<?php

use Illuminate\Support\Facades\Route;

//memanggil file login_controller yg ada di folder Controllers
use App\Http\Controllers\login_controller;

//memanggil file uji_controller yg ada di folder Controllers
use App\Http\Controllers\uji_controller;

//memanggil file uji_model yg ada di folder Models
use App\Models\uji_model;

//memanggil file gedung_controller yg ada di folder Controllers
use App\Http\Controllers\gedung_controller;

//memanggil file gedung_model yg ada di folder Models
use App\Models\gedung_model;


//memanggil file ruangan_controller yg ada di folder Controllers
use App\Http\Controllers\ruangan_controller;

//memanggil file ruangan_model yg ada di folder Models
use App\Models\ruangan_model;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

        // Count total records
        $data_uji_jumlah = uji_model::count();

        // Define an array of variables to pass to the view
        $data_uji_kondisi = [
            'data_uji_jumlah' => $data_uji_jumlah,
            // Count 'Aktif' status records
            'aktif_count' => uji_model::where('Status', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'tidak_aktif_count' => uji_model::where('Status', 'Tidak_Aktif')->count(),
            // Add more variables here if needed
        ];

         // Count total records
        $data_gedung_jumlah = gedung_model::count();

        // Define an array of variables to pass to the view
        $data_gedung_kondisi = [
            'data_gedung_jumlah' => $data_gedung_jumlah,
            // Count 'Aktif' status records
            'gedung_aktif_count' => gedung_model::where('Status_Gedung', 'Aktif')->count(),
            // Count 'Tidak_Aktif' status records
            'gedung_tidak_aktif_count' => gedung_model::where('Status_Gedung', 'Tidak_Aktif')->count(),
            // Count 'Lainya' status records
            'gedung_lainya_count' => gedung_model::where('Status_Gedung', 'Lainya')->count(),
            // Add more variables here if needed
        ];

        return view('welcome',

        $data_uji_kondisi,
        $data_gedung_kondisi

        );
    })->middleware('auth');


    /*  Route Register
    */
Route::get('/register', [login_controller::class,'register'])->name('register');

    /*  Route Register_user
    */
Route::post('/register_user', [login_controller::class,'register_user'])->name('register_user');

    /*  Route login
    */
Route::get('/login', [login_controller::class,'login'])->name('login');

    /*  Route login_user
    */
Route::post('/login_user', [login_controller::class,'login_user'])->name('login_user');

    /*  Route logout
    */
Route::get('/logout', [login_controller::class,'logout'])->name('logout');

//tabel uji
    /*  memanggil file 'uji_controller' yg ada di folder controller
        /data_uji ->file data_uji.blade.php & 'index_uji' -> fungsi 'index_uji' yg ada di file uji_controller
        tag ->middleware('auth') berfungsi untuk keamanan jadi pengguna harus login dahulu jika tidak tidak mendapatkan akses
    */
Route::get('/data_uji', [uji_controller::class,'index_uji'])->name('index_uji')->middleware('auth');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        /create_data_uji ->file create_data_uji.blade.php & 'create_data_uji' -> fungsi 'create_data_uji' yg ada di file uji_controller
    */
Route::get('/create_data_uji', [uji_controller::class,'create_data_uji'])->name('create_data_uji')->middleware('auth');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        'insert_data_uji' -> fungsi 'insert_data_uji' yg ada di file uji_controller
    */
Route::post('/insert_data_uji', [uji_controller::class,'insert_data_uji'])->name('insert_data_uji')->middleware('auth');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        /edit_data_uji ->file edit_data_uji.blade.php & 'edit_data_uji' -> fungsi 'edit_data_uji' yg ada di file uji_controller
    */
Route::get('/edit_data_uji/{id}', [uji_controller::class,'edit_data_uji'])->name('edit_data_uji')->middleware('auth');

     /*  memanggil file 'uji_controller' yg ada di folder controller
        'update_data_uji' -> fungsi 'update_data_uji' yg ada di file uji_controller
        {id} -> parameter yg menjadi acuan dalam hal edit
    */
Route::post('/update_data_uji/{id}', [uji_controller::class,'update_data_uji'])->name('update_data_uji')->middleware('auth');


    /*  memanggil file 'uji_controller' yg ada di folder controller
        'delete_data_uji' -> fungsi 'delete_data_uji' yg ada di file uji_controller
        {id} -> parameter yg menjadi acuan dalam hal edit
    */
Route::get('/delete_data_uji/{id}', [uji_controller::class,'delete_data_uji'])->name('delete_data_uji')->middleware('auth');

    /*  Export Pdf
    */
Route::get('/export_pdf_uji', [uji_controller::class,'export_pdf_uji'])->name('export_pdf_uji')->middleware('auth');

    /*  Export Excel
    */
Route::get('/export_excel_uji', [uji_controller::class,'export_excel_uji'])->name('export_excel_uji')->middleware('auth');

    /*  import Excel
    */
Route::post('/uji_excel_import', [uji_controller::class,'uji_excel_import'])->name('uji_excel_import')->middleware('auth');

    /*  Melihat satu data uji
    */
Route::get('/lihat_data_uji/{id}', [uji_controller::class,'lihat_data_uji'])->name('lihat_data_uji');


//tabel gedung

//tampil data
    Route::get('/gedung_data', [gedung_controller::class,'gedung_index'])->name('gedung_index')->middleware('auth');

//insert data
    Route::get('/gedung_create', [gedung_controller::class,'gedung_create'])->name('gedung_create')->middleware('auth');
    Route::post('/gedung_insert', [gedung_controller::class,'gedung_insert'])->name('gedung_insert')->middleware('auth');

//edit data
    Route::get('/gedung_edit/{id}', [gedung_controller::class,'gedung_edit'])->name('gedung_edit')->middleware('auth');
    Route::post('/gedung_update/{id}', [gedung_controller::class,'gedung_update'])->name('gedung_update')->middleware('auth');

//export PDF
    Route::get('/gedung_export_pdf', [gedung_controller::class,'gedung_export_pdf'])->name('gedung_export_pdf')->middleware('auth');


//tabel ruangan

//tampil data
Route::get('/ruangan_data', [ruangan_controller::class,'ruangan_index'])->name('ruangan_index')->middleware('auth');

//insert data
    Route::get('/ruangan_create', [ruangan_controller::class,'ruangan_create'])->name('ruangan_create')->middleware('auth');
    Route::post('/ruangan_insert', [ruangan_controller::class,'ruangan_insert'])->name('ruangan_insert')->middleware('auth');

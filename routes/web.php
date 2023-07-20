<?php

use Illuminate\Support\Facades\Route;

//memanggil file login_controller yg ada di folder Controllers
use App\Http\Controllers\login_controller;

//memanggil file uji_controller yg ada di folder Controllers
use App\Http\Controllers\uji_controller;

//memanggil file uji_model yg ada di folder Models
use App\Models\uji_model;


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

        return view('welcome',

        $data_uji_kondisi

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
Route::post('/insert_data_uji', [uji_controller::class,'insert_data_uji'])->name('insert_data_uji');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        /edit_data_uji ->file edit_data_uji.blade.php & 'edit_data_uji' -> fungsi 'edit_data_uji' yg ada di file uji_controller
    */
Route::get('/edit_data_uji/{id}', [uji_controller::class,'edit_data_uji'])->name('edit_data_uji')->middleware('auth');

     /*  memanggil file 'uji_controller' yg ada di folder controller
        'update_data_uji' -> fungsi 'update_data_uji' yg ada di file uji_controller
        {id} -> parameter yg menjadi acuan dalam hal edit
    */
Route::post('/update_data_uji/{id}', [uji_controller::class,'update_data_uji'])->name('update_data_uji');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        'delete_data_uji' -> fungsi 'delete_data_uji' yg ada di file uji_controller
        {id} -> parameter yg menjadi acuan dalam hal edit
    */
Route::get('/delete_data_uji/{id}', [uji_controller::class,'delete_data_uji'])->name('delete_data_uji');

    /*  Export Pdf
    */
Route::get('/export_pdf_uji', [uji_controller::class,'export_pdf_uji'])->name('export_pdf_uji');

    /*  Export Excel
    */
Route::get('/export_excel_uji', [uji_controller::class,'export_excel_uji'])->name('export_excel_uji');

    /*  import Excel
    */
Route::post('/uji_excel_import', [uji_controller::class,'uji_excel_import'])->name('uji_excel_import');

    /*  Melihat satu data uji
    */
Route::get('/lihat_data_uji/{id}', [uji_controller::class,'lihat_data_uji'])->name('lihat_data_uji');

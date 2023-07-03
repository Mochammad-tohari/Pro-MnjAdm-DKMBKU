<?php

use Illuminate\Support\Facades\Route;

//memanggil file uji_controller yg ada di folder controller
use App\Http\Controllers\uji_controller;



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
    return view('welcome');
});

//tabel uji
    /*  memanggil file 'uji_controller' yg ada di folder controller
        /data_uji ->file data_uji.blade.php & 'index_uji' -> fungsi 'index_uji' yg ada di file uji_controller
    */
    Route::get('/data_uji', [uji_controller::class,'index_uji'])->name('index_uji');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        /create_data_uji ->file create_data_uji.blade.php & 'create_data_uji' -> fungsi 'create_data_uji' yg ada di file uji_controller
    */
Route::get('/create_data_uji', [uji_controller::class,'create_data_uji'])->name('create_data_uji');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        'insert_data_uji' -> fungsi 'insert_data_uji' yg ada di file uji_controller
    */
Route::post('/insert_data_uji', [uji_controller::class,'insert_data_uji'])->name('insert_data_uji');

    /*  memanggil file 'uji_controller' yg ada di folder controller
        /edit_data_uji ->file edit_data_uji.blade.php & 'edit_data_uji' -> fungsi 'edit_data_uji' yg ada di file uji_controller
    */
Route::get('/edit_data_uji/{id}', [uji_controller::class,'edit_data_uji'])->name('edit_data_uji');

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
Route::get('/exportpdf', [uji_controller::class,'exportpdf'])->name('exportpdf');

    /*  Melihat satu data uji 
    */
Route::get('/lihat_data_uji/{id}', [uji_controller::class,'lihat_data_uji'])->name('lihat_data_uji');
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "uji_bidang_model" dari folder models
use App\Models\uji_bidang_model;

// import class uuid
use Illuminate\Support\Str;

class uji_user_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'uji_user';

    //memasukan semua data
    protected $guarded = [];

    /*
    mengambil informasi di table ruangan
    'Jabatan_Uji_User' = field yang ada di table pengurus_dkm
    'Kode_Bidang' = field yang diambil dari table uji_bidang
    */
    public function ambil_kode_uji_bidang()
    {
        return $this->belongsTo(uji_bidang_model::class, 'Jabatan_Uji_User', 'Kode_Bidang');
    }

    /*$primaryKey = menegaskan field primary key adalah "id_uji_user"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_uji_user';
    public $incrementing = false;


    //sintax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_uji_user = Str::uuid(); // Generates a UUID
        });
    }


    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($uji_user) {
            if (auth()->check()) {
                $uji_user->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($uji_user) {
            if (auth()->check()) {
                $uji_user->updated_by = auth()->user()->email;
            }
        });
    }
}

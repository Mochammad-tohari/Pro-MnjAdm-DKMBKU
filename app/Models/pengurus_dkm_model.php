<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "bidang_pengurus_dkm_model" dari folder models
use App\Models\bidang_pengurus_dkm_model;

// import class uuid
use Illuminate\Support\Str;

class pengurus_dkm_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'pengurus_dkm';

    //memasukan semua data
    protected $guarded = [];

    /*
    mengambil informasi di table ruangan
    'Kode_pengurus' = field yang ada di table pengurus_dkm
    'Kode_Bidang_pengurus' = field yang diambil dari table bidang_pengurus
    */
    public function ambil_kode_bidang_pengurus()
    {
        return $this->belongsTo(bidang_pengurus_dkm_model::class, 'Jabatan_Pengurus_DKM', 'Kode_Bidang_Pengurus_DKM');
    }

    /*$primaryKey = menegaskan field primary key adalah "id_pengurus_dkm"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_pengurus_dkm';
    public $incrementing = false;


    //sintax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_pengurus_dkm = Str::uuid(); // Generates a UUID
        });
    }


    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($pengurus_dkm) {
            if (auth()->check()) {
                $pengurus_dkm->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($pengurus_dkm) {
            if (auth()->check()) {
                $pengurus_dkm->updated_by = auth()->user()->email;
            }
        });
    }
}

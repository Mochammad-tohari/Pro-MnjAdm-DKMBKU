<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "bidang_khodim_model" dari folder models
use App\Models\bidang_khodim_model;

// import class uuid
use Illuminate\Support\Str;

class khodim_dkm_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
            protected $table = 'khodim_dkm';

            //memasukan semua data
            protected $guarded = [];

            /*
            mengambil informasi di table ruangan
            'Kode_Khodim' = field yang ada di table khodim_dkm
            'Kode_Bidang_Khodim' = field yang diambil dari table bidang_khodim
            */
            public function ambil_kode_bidang_khodim()
            {
                return $this->belongsTo(gedung_model::class, 'Kode_Khodim', 'Kode_Bidang_Khodim ');
            }

            /*$primaryKey = menegaskan field primary key adalah "id"
            $incrementing = mendisable auto increment
            */
            protected $primaryKey = 'id_khodim';
            public $incrementing = false;


            //sintax utk menerapkan uuid
            protected static function boot()
            {
                parent::boot();

                static::creating(function ($model) {
                    $model->id_khodim = Str::uuid(); // Generates a UUID
                });
            }


            //syntax tracking olah data
            protected static function booted()
            {
                static::creating(function ($khodim_dkm) {
                    if (auth()->check()) {
                        $khodim_dkm->inserted_by = auth()->user()->email;
                    }
                });

                static::updating(function ($khodim_dkm) {
                    if (auth()->check()) {
                        $khodim_dkm->updated_by = auth()->user()->email;
                    }
                });
            }
}

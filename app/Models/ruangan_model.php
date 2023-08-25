<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "gedung_model" dari folder models
use App\Models\gedung_model;

// import class uuid
use Illuminate\Support\Str;

class ruangan_model extends Model
{
    use HasFactory;

            //memperjelas nama tabel yang ada di database
            protected $table = 'ruangan';

            //memasukan semua data
            protected $guarded = [];

            /*
            mengambil informasi di table ruangan
            'Gedung_Kode' = field yang ada di table ruangan
            'Kode_Gedung' = field yang diambil dari table gedung
            */
            public function gedung()
            {
                return $this->belongsTo(gedung_model::class, 'Gedung_Kode', 'Kode_Gedung');
            }

            /*$primaryKey = menegaskan field primary key adalah "id"
            $incrementing = mendisable auto increment
            */
            protected $primaryKey = 'id_ruangan';
            public $incrementing = false;


            //sintax utk menerapkan uuid
            protected static function boot()
            {
                parent::boot();

                static::creating(function ($model) {
                    $model->id_ruangan = Str::uuid(); // Generates a UUID
                });
            }
}

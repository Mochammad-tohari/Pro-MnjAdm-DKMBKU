<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "gedung_model" dari folder models
use App\Models\gedung_model;

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
}

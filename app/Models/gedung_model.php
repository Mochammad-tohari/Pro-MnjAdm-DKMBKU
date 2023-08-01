<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "ruangan_model" dari folder models
use App\Models\ruangan_model;

class gedung_model extends Model
{
    use HasFactory;

        //memperjelas nama tabel yang ada di database
        protected $table = 'gedung';

        //memasukan semua data
        protected $guarded = [];

        //mengambil informasi di table ruangan
        public function ruangan()
        {
            return $this->hasMany(ruangan_model::class);
        }
}

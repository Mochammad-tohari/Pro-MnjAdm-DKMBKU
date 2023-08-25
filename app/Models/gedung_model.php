<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "ruangan_model" dari folder models
use App\Models\ruangan_model;

// import class uuid
use Illuminate\Support\Str;


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

        /*$primaryKey = menegaskan field primary key adalah "id"
        $incrementing = mendisable auto increment
        */
        protected $primaryKey = 'id_gedung';
        public $incrementing = false;


        //sintax utk menerapkan uuid
        protected static function boot()
        {
            parent::boot();

            static::creating(function ($model) {
                $model->id_gedung = Str::uuid(); // Generates a UUID
            });
        }
}

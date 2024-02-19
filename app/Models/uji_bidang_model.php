<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import class uuid
use Illuminate\Support\Str;

class uji_bidang_model extends Model
{
    use HasFactory;


    //memperjelas nama tabel yang ada di database
    protected $table = 'uji_bidang';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_uji_bidang';
    public $incrementing = false;


    //syntax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_uji_bidang = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($uji_bidang) {
            if (auth()->check()) {
                $uji_bidang->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($uji_bidang) {
            if (auth()->check()) {
                $uji_bidang->updated_by = auth()->user()->email;
            }
        });
    }
}

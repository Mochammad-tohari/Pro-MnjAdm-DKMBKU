<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import class uuid
use Illuminate\Support\Str;

class pengajar_madrasah_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'pengajar_madrasah';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_pengajar';
    public $incrementing = false;


    //sintax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_pengajar = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($pengajar_madrasah) {
            if (auth()->check()) {
                $pengajar_madrasah->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($pengajar_madrasah) {
            if (auth()->check()) {
                $pengajar_madrasah->updated_by = auth()->user()->email;
            }
        });
    }

}

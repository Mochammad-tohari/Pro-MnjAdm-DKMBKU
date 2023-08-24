<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import class uuid
use Illuminate\Support\Str;

class uji_model extends Model
{
    use HasFactory;


    //memperjelas nama tabel yang ada di database
    protected $table = 'uji';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id';
    public $incrementing = false;


    //sintax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid(); // Generates a UUID
        });
    }
}

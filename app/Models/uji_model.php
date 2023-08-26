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


    //syntax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($uji) {
            if (auth()->check()) {
                $uji->inserted_by_email = auth()->user()->email;
            }
        });

        static::updating(function ($uji) {
            if (auth()->check()) {
                $uji->updated_by_email = auth()->user()->email;
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// import class uuid
use Illuminate\Support\Str;

class bidang_khodim_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'bidang_khodim';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_bidang_khodim';
    public $incrementing = false;


    //syntax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_bidang_khodim = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($bidang_khodim) {
            if (auth()->check()) {
                $bidang_khodim->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($bidang_khodim) {
            if (auth()->check()) {
                $bidang_khodim->updated_by = auth()->user()->email;
            }
        });
    }
}

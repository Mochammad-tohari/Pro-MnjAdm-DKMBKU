<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// import class uuid
use Illuminate\Support\Str;

class majlistalim_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'majlistalim';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_majlistalim';
    public $incrementing = false;


    //sintax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_majlistalim = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($majlistalim) {
            if (auth()->check()) {
                $majlistalim->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($majlistalim) {
            if (auth()->check()) {
                $majlistalim->updated_by = auth()->user()->email;
            }
        });
    }
}

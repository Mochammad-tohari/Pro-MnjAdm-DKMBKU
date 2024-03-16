<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "pengurus_nawa_model" dari folder models
use App\Models\pengurus_nawa_model;

// import class uuid
use Illuminate\Support\Str;

class bidang_nawa_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'bidang_nawa';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_bidang_nawa';
    public $incrementing = false;


    //memberi informasi di table pengurus_nawa
    public function pengurus_nawa()
    {
        return $this->hasMany(pengurus_nawa_model::class);
    }

    //syntax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_bidang_nawa = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($bidang_nawa) {
            if (auth()->check()) {
                $bidang_nawa->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($bidang_nawa) {
            if (auth()->check()) {
                $bidang_nawa->updated_by = auth()->user()->email;
            }
        });
    }
}

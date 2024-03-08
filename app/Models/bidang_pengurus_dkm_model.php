<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "pengurus_dkm_model" dari folder models
use App\Models\pengurus_dkm_model;


// import class uuid
use Illuminate\Support\Str;

class bidang_pengurus_dkm_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'bidang_pengurus_dkm';

    //memasukan semua data
    protected $guarded = [];

    /*$primaryKey = menegaskan field primary key adalah "id"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_bidang_pengurus_dkm';
    public $incrementing = false;


    //memberi informasi di table pengurus dkm
    public function pengurus_dkm()
    {
        return $this->hasMany(pengurus_dkm_model::class);
    }

    //syntax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_bidang_pengurus_dkm = Str::uuid(); // Generates a UUID
        });
    }

    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($bidang_pengurus_dkm) {
            if (auth()->check()) {
                $bidang_pengurus_dkm->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($bidang_pengurus_dkm) {
            if (auth()->check()) {
                $bidang_pengurus_dkm->updated_by = auth()->user()->email;
            }
        });
    }
}

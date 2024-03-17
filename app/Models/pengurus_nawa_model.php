<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import Model "bidang_nawa_model" dari folder models
use App\Models\bidang_nawa_model;

// import class uuid
use Illuminate\Support\Str;

class pengurus_nawa_model extends Model
{
    use HasFactory;

    //memperjelas nama tabel yang ada di database
    protected $table = 'pengurus_nawa';

    //memasukan semua data
    protected $guarded = [];

    /*
    mengambil informasi di table ruangan
    'Jabatan_Pengurus_Nawa' = field yang ada di table pengurus_nawa
    'Kode_Bidang_nawa' = field yang diambil dari table bidang_nawa
    */
    public function ambil_kode_bidang_nawa()
    {
        return $this->belongsTo(bidang_nawa_model::class, 'Jabatan_Pengurus_Nawa', 'Kode_Bidang_Nawa');
    }

    /*$primaryKey = menegaskan field primary key adalah "id_pengurus_nawa"
    $incrementing = mendisable auto increment
    */
    protected $primaryKey = 'id_pengurus_nawa';
    public $incrementing = false;


    //sintax utk menerapkan uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_pengurus_nawa = Str::uuid(); // Generates a UUID
        });
    }


    //syntax tracking olah data
    protected static function booted()
    {
        static::creating(function ($pengurus_nawa) {
            if (auth()->check()) {
                $pengurus_nawa->inserted_by = auth()->user()->email;
            }
        });

        static::updating(function ($pengurus_nawa) {
            if (auth()->check()) {
                $pengurus_nawa->updated_by = auth()->user()->email;
            }
        });
    }
}

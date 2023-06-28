<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uji_model extends Model
{
    use HasFactory;

    
    //memperjelas nama tabel yang ada di database
    protected $table = 'uji'; 

    //memasukan semua data
    protected $guarded = [];
}

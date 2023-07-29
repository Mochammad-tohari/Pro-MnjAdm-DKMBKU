<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gedung_model extends Model
{
    use HasFactory;

        //memperjelas nama tabel yang ada di database
        protected $table = 'gedung';

        //memasukan semua data
        protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    public function kerusakan(){
        return $this->belongsTo(Kerusakan::class, 'kode_kerusakan', 'kode_kerusakan');
    }
}

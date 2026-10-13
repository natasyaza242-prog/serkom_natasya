<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujikom extends Model
{
    protected $table = 'ujikoms';

    protected $fillable = [
        'nama_siswa',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'rata_rata',
        'status',
    ];
}
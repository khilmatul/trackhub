<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkutan extends Model
{
    use HasFactory;
    protected $table = 'angkutans';
    protected $fillable = [
        'no_polisi','nama_angkutan','sopir','trayek_id','tanggal'
    ];

    protected $guarded = '';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    protected $table = 'penumpangs';
    protected $fillable = ['
    qrcode','tgl_input_penumpang','nama','alamat','tgl_lahir','no_telp','asal_sekolah'];

    protected $guarded = '';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}

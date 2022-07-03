<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trayek extends Model
{
    use HasFactory;

    protected $table = 'trayeks';
    protected $guarded = '';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}

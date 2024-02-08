<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'addres_a',
        'addres_b',
        'whatsapp',
        'tel',
        'mail',
        'grafic',
    ];
}

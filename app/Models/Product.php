<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'trek_kod',
        'kod',
        'weight',
        'receipt_A',
        'dispatch_A',
        'receipt_B',
        'issue',
        'price',
        'payment',
    ];
}

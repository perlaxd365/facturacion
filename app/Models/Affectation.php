<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'igv',
        'free'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

}

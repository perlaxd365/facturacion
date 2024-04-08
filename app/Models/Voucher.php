<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document_id'
    ];

    //Relacion uno a muchos inversa
    public function document(){
        return $this->belongsTo(Document::class);
    }

    //Relacion muchos a muchos
    public function branches(){
        return $this->belongsToMany(Branch::class)
            ->withPivot('serie', 'correlativo')
            ->withTimestamps();
    }
}

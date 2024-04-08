<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'description'];

    public $incrementing = false;

    protected $keyType = 'string';

    //Relacion muchos a muchos
    public function documents(){
        return $this->belongsToMany(Document::class, 'document_identity_operation')
            ->withPivot('operation_id')
            ->withTimestamps();
    }

    public function operations(){
        return $this->belongsToMany(Operation::class, 'document_identity_operation')
            ->withPivot('document_id')
            ->withTimestamps();
    }

}

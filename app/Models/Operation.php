<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'description'];

    public $incrementing = false;

    protected $keyType = 'string';

    //Relaion muchos a muchos
    public function documents(){
        return $this->belongsToMany(Document::class, 'document_identity_operation')
            ->withPivot('identity_id')
            ->withTimestamps();
    }

    public function identities(){
        return $this->belongsToMany(Identity::class, 'document_identity_operation')
            ->withPivot('document_id')
            ->withTimestamps();
    }

    public function affectations()
    {
        return $this->belongsToMany(Affectation::class)
            ->withTimestamps();
    }

}

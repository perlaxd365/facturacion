<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'description'];

    public $incrementing = false;

    protected $keyType = 'string';

    //Relacion uno a muchos
    public function vouchers(){
        return $this->hasMany(Voucher::class);
    }

    //Relacion muchos a muchos
    public function operations(){
        return $this->belongsToMany(Operation::class, 'document_identity_operation')
            ->withPivot('identity_id')
            ->withTimestamps();
    }

    public function identities(){
        return $this->belongsToMany(Identity::class, 'document_identity_operation')
            ->withPivot('operation_id')
            ->withTimestamps();
    }
    
}

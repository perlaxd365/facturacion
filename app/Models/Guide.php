<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipoDoc', 
        'serie', 
        'correlativo', 
        'fechaEmision', 
        'company', 
        'destinatario', 
        'envio', 
        'details', 
        'branch_id'
    ];

    protected $casts = [
        'fechaEmision' => 'datetime',
        'company' => 'collection',
        'destinatario' => 'collection',
        'envio' => 'collection',
        'details' => 'collection',

        //Sunat
        'sunat_error' => 'collection',
        'cdr_notes' => 'collection',
    ];

    //Relacion uno a muchos inversa
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}

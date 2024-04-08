<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipoOperacion',
        'tipoDoc',
        'serie',
        'correlativo',
        'fechaEmision',

        'tipDocAfectado',
        'numDocfectado',
        'codMotivo',
        'desMotivo',

        'formaPago',
        'cuotas',
        'tipoMoneda',
        'company',
        'client',
        'mtoOperGravadas',
        'mtoOperExoneradas',
        'mtoOperInafectas',
        'mtoOperExportacion',
        'mtoOperGratuitas',
        'mtoIGV',
        'mtoIGVGratuitas',
        'icbper',
        'totalImpuestos',
        'valorVenta',
        'subTotal',
        'mtoImpVenta',
        'anticipos',
        'detraccion',
        'details',
        'legends',

        //Branch
        'branch_id'
    ];

    protected $casts = [
        'fechaEmision' => 'datetime',
        'formaPago' => 'collection',
        'cuotas' => 'collection',
        'company' => 'collection',
        'client' => 'collection',
        'anticipos' => 'collection',
        'detraccion' => 'collection',
        'details' => 'collection',
        'legends' => 'collection',
        'sunat_error' => 'collection',
        'cdr_notes' => 'collection',
    ];

    //Relacion uno a muchos inversa
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}

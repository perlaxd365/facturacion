<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion', 
        'department_id', 
        'province_id', 
        'district_id'
    ];

    //Relacion polimorfica
    public function addressable()
    {
        return $this->morphTo();
    }

    //Relacion uno a muchos inversa
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

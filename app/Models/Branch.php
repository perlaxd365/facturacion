<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'phone',
        'email',
        'website',
        'company_id',
    ];

    //Relacion uno a muchos
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    //Relacion uno a muchos inversa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //Relacion muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class);
    }

    //Relacion muchos a muchos
    public function vouchers(){
        return $this->belongsToMany(Voucher::class)
            ->withPivot('serie', 'correlativo')
            ->withTimestamps()
            ->orderByPivot('voucher_id', 'asc');
    }

    //Relacion uno a uno polimorfica
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}

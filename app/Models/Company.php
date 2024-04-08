<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'regimen',
        'ruc',
        'razonSocial',
        'nombreComercial',
        'phone',
        'email',
        
        'user_sol',
        'password_sol',
        'client_id',
        'client_secret',

        'certificate',
        'certificate_path',
        'square_image_path',
        'rectangle_image_path',
    ];

    protected $casts = [
        'regimen' => \App\Enums\Regimen::class,
    ];

    //Route Model Binding
    public function getRouteKeyName()
    {
        return 'domain';
    }

    //Mutadores y accesores
    protected function squareImage():Attribute
    {
        return new Attribute(
            get: fn() => $this->square_image_path ? Storage::url($this->square_image_path) : 'https://codersfree.nyc3.digitaloceanspaces.com/companies/logos/square_logo.png',
        );
    }

    protected function rectangleImage():Attribute
    {
        return new Attribute(
            get: fn() => $this->rectangle_image_path ? Storage::url($this->rectangle_image_path) : 'https://codersfree.nyc3.digitaloceanspaces.com/companies/logos/rectangle_logo.png',
        );
    }

    protected function phone():Attribute
    {
        return new Attribute(
            get: fn($value) => $value ? $value : 'S/N',
        );
    }


    //Relacion uno a muchos
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    //Relacion muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class)
            ->withPivot('is_admin')
            ->withTimestamps();
    }

    //Relacion uno a uno polimorfica
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}

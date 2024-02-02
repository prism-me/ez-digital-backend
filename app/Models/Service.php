<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'route',
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'route';
    }

    public function package(){
        
        return $this->belongsToMany('App\Models\Package')->withPivot('services_packages_detail');


    }

    public function price(){
        
        return $this->hasMany(PackagePrice::class);


    }
}

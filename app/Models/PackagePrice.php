<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePrice extends Model
{
    use HasFactory;
     protected $table = 'packages_prices';
    protected $fillable = [
        'package_id' , 'service_id','amount' ,'plan_id'
    ];

    
}

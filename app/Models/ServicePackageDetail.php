<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackageDetail extends Model
{
    use HasFactory;
    protected $table = 'services_packages_detail';
    protected $fillable = [
        'package_id' , 'service_id','name' ,'description'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'plan_id',
        'package_id',
        'service_id'
    ];
}

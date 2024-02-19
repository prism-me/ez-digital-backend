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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
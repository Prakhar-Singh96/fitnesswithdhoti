<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IplTeam extends Model {
    protected $fillable = ['name', 'logo', 'coupon_code', 'status'];
}

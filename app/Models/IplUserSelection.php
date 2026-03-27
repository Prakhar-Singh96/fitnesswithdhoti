<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IplUserSelection extends Model {
    protected $fillable = ['user_id', 'team_id', 'is_winner', 'coupon_activated_at'];

    public function team() {
        return $this->belongsTo(IplTeam::class, 'team_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'avatar',
        'shop_name',  // Only for sellers
        'gst_number', // Only for sellers
    ];

    // Relationship back to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

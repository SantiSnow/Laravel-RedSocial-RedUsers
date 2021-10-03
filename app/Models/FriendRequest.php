<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable = [
        'user_id',
        'user_requested',
        'accepted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_requested()
    {
        return $this->belongsTo(User::class, 'user_requested');
    }

    use HasFactory;
}

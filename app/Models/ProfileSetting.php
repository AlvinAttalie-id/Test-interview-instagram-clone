<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileSetting extends Model
{

    use HasFactory, SoftDeletes;
    //
    protected $fillable = [
        'user_id',
        'bio',
        'profile_picture',
        'feed_per_row'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'work_id',
        'user_id',
        'body',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

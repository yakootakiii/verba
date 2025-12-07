<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriterApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // optional alias if you prefer "reader" name
    public function reader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

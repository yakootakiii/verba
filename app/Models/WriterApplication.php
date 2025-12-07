<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriterApplication extends Model
{
    use HasFactory;

    // Optional if your table name is non-standard
    // protected $table = 'writer_applications';

    protected $fillable = [
        'user_id',
        'reason',
        'status',
    ];

    /**
     * The user who submitted the application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias for clarity (reader submitting the application)
     */
    public function reader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope to get only pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get only approved applications
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get only rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}

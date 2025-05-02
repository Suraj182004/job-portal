<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'cover_letter',
        'cv_link',
        'phone',
        // Add other fillable fields if needed (e.g., 'cover_letter')
    ];

    /**
     * Get the user (applicant) who owns the application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job that the application is for.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}

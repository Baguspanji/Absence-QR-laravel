<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'qr_code_token',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($feedback) {
            $feedback->qr_code_token = Str::random(32);
        });
    }

    /**
     * Get the user that created the feedback.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the responses for this feedback.
     */
    public function responses(): HasMany
    {
        return $this->hasMany(FeedbackResponse::class);
    }

    /**
     * Get feedback URL for QR Code.
     */
    public function getFeedbackUrl(): string
    {
        return url("/public-feedback/{$this->qr_code_token}");
    }

    /**
     * Count the total number of responses.
     */
    public function getTotalResponsesCount(): int
    {
        return $this->responses()->count();
    }
}

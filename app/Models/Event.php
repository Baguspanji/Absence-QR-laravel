<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'qr_code_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->qr_code_token = Str::random(32);
        });
    }

    /**
     * Get the user that created the event.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attendees for this event.
     */
    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }

    /**
     * Get attendance URL for QR Code.
     */
    public function getAttendanceUrl(): string
    {
        return url("/attend/{$this->qr_code_token}");
    }

    /**
     * Count the number of attendees who have checked in.
     */
    public function getCheckedInCount(): int
    {
        return $this->attendees()->whereNotNull('attendance_time')->count();
    }

    /**
     * Count the total number of attendees.
     */
    public function getTotalAttendeesCount(): int
    {
        return $this->attendees()->count();
    }
}

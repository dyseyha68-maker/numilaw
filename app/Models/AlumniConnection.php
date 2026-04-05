<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniConnection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'requester_id',
        'recipient_id',
        'message',
        'status',
        'accepted_at',
        'declined_at',
        'decline_reason',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'declined_at' => 'datetime',
    ];

    // Relationships
    public function requester(): BelongsTo
    {
        return $this->belongsTo(Alumni::class, 'requester_id');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Alumni::class, 'recipient_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    public function scopeWithdrawn($query)
    {
        return $query->where('status', 'withdrawn');
    }

    // Accessors
    public function getStatusDisplayAttribute()
    {
        $statuses = [
            'pending' => app()->getLocale() === 'km' ? 'កំពុងរង់ចាំ' : 'Pending',
            'accepted' => app()->getLocale() === 'km' ? 'បានយល់ព្រម' : 'Accepted',
            'declined' => app()->getLocale() === 'km' ? 'បានបដិសេធ' : 'Declined',
            'withdrawn' => app()->getLocale() === 'km' ? 'បានដក' : 'Withdrawn',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getRequesterNameAttribute()
    {
        return $this->requester ? $this->requester->full_name : null;
    }

    public function getRecipientNameAttribute()
    {
        return $this->recipient ? $this->recipient->full_name : null;
    }

    // Methods
    public function accept()
    {
        $this->status = 'accepted';
        $this->accepted_at = now();
        $this->declined_at = null;
        $this->decline_reason = null;
        $this->save();
    }

    public function decline($reason = null)
    {
        $this->status = 'declined';
        $this->declined_at = now();
        $this->decline_reason = $reason;
        $this->accepted_at = null;
        $this->save();
    }

    public function withdraw()
    {
        $this->status = 'withdrawn';
        $this->save();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    public function isDeclined()
    {
        return $this->status === 'declined';
    }

    public function isWithdrawn()
    {
        return $this->status === 'withdrawn';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniDonation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'alumni_id',
        'amount',
        'currency',
        'donation_type',
        'campaign',
        'is_anonymous',
        'transaction_id',
        'payment_method',
        'donation_date',
        'notes',
        'receipt_url',
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'donation_date' => 'date',
        'is_anonymous' => 'boolean',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    // Relationships
    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeUnverified($query)
    {
        return $query->where('is_verified', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('donation_type', $type);
    }

    public function scopeByCampaign($query, $campaign)
    {
        return $query->where('campaign', $campaign);
    }

    public function scopeAnonymous($query)
    {
        return $query->where('is_anonymous', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_anonymous', false);
    }

    public function scopeByYear($query, $year)
    {
        return $query->whereYear('donation_date', $year);
    }

    public function scopeByCurrency($query, $currency)
    {
        return $query->where('currency', $currency);
    }

    // Accessors
    public function getDonationTypeDisplayAttribute()
    {
        $types = [
            'one-time' => app()->getLocale() === 'km' ? 'លើកមួយ' : 'One-time',
            'recurring' => app()->getLocale() === 'km' ? 'ដាច់ខាត' : 'Recurring',
            'scholarship' => app()->getLocale() === 'km' ? 'អាហារូបករណ៍' : 'Scholarship',
            'infrastructure' => app()->getLocale() === 'km' ? 'ហេដ្ឋារចនាសម្ព័ន្ធ' : 'Infrastructure',
            'equipment' => app()->getLocale() === 'km' ? 'ឧបករណ៍' : 'Equipment',
            'library' => app()->getLocale() === 'km' ? 'បណ្ណាល័យ' : 'Library',
            'research' => app()->getLocale() === 'km' ? 'ការស្រាវជ្រាវ' : 'Research',
            'general' => app()->getLocale() === 'km' ? 'ទូទៅ' : 'General',
        ];

        return $types[$this->donation_type] ?? $this->donation_type;
    }

    public function getPaymentMethodDisplayAttribute()
    {
        $methods = [
            'credit_card' => app()->getLocale() === 'km' ? 'កាតឥណទាន' : 'Credit Card',
            'bank_transfer' => app()->getLocale() === 'km' ? 'ផ្ទេរតាមធនាគារ' : 'Bank Transfer',
            'check' => app()->getLocale() === 'km' ? 'ឆេក' : 'Check',
            'cash' => app()->getLocale() === 'km' ? 'សាច់ប្រាក់' : 'Cash',
            'online' => app()->getLocale() === 'km' ? 'លើបណ្តាញ' : 'Online Payment',
            'mobile_banking' => app()->getLocale() === 'km' ? 'ធនាគារចល័ត' : 'Mobile Banking',
        ];

        return $methods[$this->payment_method] ?? $this->payment_method;
    }

    public function getFormattedAmountAttribute()
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }

    public function getDonorNameAttribute()
    {
        if ($this->is_anonymous) {
            return app()->getLocale() === 'km' ? 'អនាមិក' : 'Anonymous';
        }

        return $this->alumni ? $this->alumni->full_name : null;
    }

    public function getDonorGraduationYearAttribute()
    {
        return $this->alumni ? $this->alumni->graduation_year : null;
    }

    public function getReceiptUrlAttribute()
    {
        return $this->receipt_file ? asset('storage/' . $this->receipt_file) : null;
    }

    // Methods
    public function verify($verifiedById)
    {
        $this->is_verified = true;
        $this->verified_at = now();
        $this->verified_by = $verifiedById;
        $this->save();
    }

    public function unverify()
    {
        $this->is_verified = false;
        $this->verified_at = null;
        $this->verified_by = null;
        $this->save();
    }

    public function makeAnonymous()
    {
        $this->is_anonymous = true;
        $this->save();
    }

    public function makePublic()
    {
        $this->is_anonymous = false;
        $this->save();
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('transaction_id', 'like', "%{$term}%")
              ->orWhere('campaign', 'like', "%{$term}%")
              ->orWhere('notes', 'like', "%{$term}%")
              ->orWhereHas('alumni', function ($alumniQuery) use ($term) {
                  $alumniQuery->whereHas('user', function ($userQuery) use ($term) {
                      $userQuery->where('name', 'like', "%{$term}%");
                  });
              });
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('donation_date', 'desc')
                    ->orderBy('created_at', 'desc');
    }

    public function scopeTotalAmount($query)
    {
        return $query->sum('amount');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionStatusLog extends Model
{
    protected $table = 'admission_status_logs';

    protected $fillable = [
        'application_id',
        'status',
        'notes',
        'changed_by',
    ];

    public function application()
    {
        return $this->belongsTo(AdmissionApplication::class, 'application_id');
    }
}

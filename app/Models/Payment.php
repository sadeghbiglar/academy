<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'paid_at',
        'cash_amount',
        'card_amount',
        'tracking_code',
        'receipt_path',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'date',
            'cash_amount' => 'integer',
            'card_amount' => 'integer',
        ];
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
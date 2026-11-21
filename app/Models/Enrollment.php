<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'enrolled_at',
        'tuition_amount',
        'discount_amount',
        'status',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'enrolled_at' => 'date',
            'tuition_amount' => 'integer',
            'discount_amount' => 'integer',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function payments()
{
    return $this->hasMany(Payment::class);
}
public function getTotalPaidAttribute(): int
{
    return (int) $this->payments()
        ->sum('cash_amount') + (int) $this->payments()
        ->sum('card_amount');
}
public function getPayableAmountAttribute(): int
{
    return $this->tuition_amount - $this->discount_amount;
}
public function getRemainingAmountAttribute(): int
{
    return max(0, $this->payable_amount - $this->total_paid);
}
}
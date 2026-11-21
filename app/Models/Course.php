<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'tuition_amount',
        'start_date',
        'end_date',
        'capacity',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    protected function casts(): array
    {
        return [
            'tuition_amount' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'capacity' => 'integer',
        ];
    }
}

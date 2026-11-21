<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'national_code',
        'email',
        'specialty',
        'bio',
        'card_number',
        'sheba_number',
        'is_active',
    ];
    public function courses()
{
    return $this->hasMany(Course::class);
}
}
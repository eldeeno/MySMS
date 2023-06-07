<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'emergency_number', 'address'];

    /**
     * Get the post's user.
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     * The students that belong to the parent.
     */
    public function children()
    {
        return $this->belongsToMany(Student::class, 'student_parent');
    }
}

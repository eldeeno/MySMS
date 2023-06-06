<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'address', 'phone_number', 'date_of_birth', 'gender', 'class_id', 'emergency_number', 'photo'];
    protected $appends = ['fullname'];
    /**
    * Get the student's full name.
     */
    protected function getFullNameAttribute()
    {
        return $this->firstname. ' ' .$this->lastname;
    }

    /**
     * The class that owns the student.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * The parent that belong to the student.
     */
    public function students()
    {
        return $this->belongsToMany(Parents::class, 'student_parent');
    }
}

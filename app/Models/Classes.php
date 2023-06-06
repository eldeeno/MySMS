<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'section'];

    /**
     * Get the students for the class.
     */
    public function students(): HasMany
    {
        return $this->HasMany(Student::class, 'class_id');
    }
}

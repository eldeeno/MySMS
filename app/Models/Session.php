<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'status'];

    /**
     * Get the terms for the session.
     */
    public function terms(): HasMany
    {
        return $this->hasMany(Term::class);
    }
}

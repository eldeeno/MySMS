<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Term extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'session_id', 'status'];

    /**
     * Get the session that owns the term.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}

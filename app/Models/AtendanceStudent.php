<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtendanceStudent extends Model
{
    use HasFactory;
    protected $fillable = ['attendance_id', 'student_id'];
}

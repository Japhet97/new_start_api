<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'principle_id',
        'title',
        'content',
        'benefits',
        'tips',
        'bible_verse'
    ];

    public function principle()
    {
        return $this->belongsTo(Principle::class);
    }
}

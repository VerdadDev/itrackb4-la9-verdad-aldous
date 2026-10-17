<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
        'rate',
        'chapter',
        'is_completed'
    ];
    
    protected function casts(): array
    {
        return [
            'rate' => 'float',
            'chapter' => 'integer',
            'is_complete' => 'boolean'
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Describe extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'title',
        'image',
        'project_id',
        'order',
        'color',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

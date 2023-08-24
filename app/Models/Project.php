<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'github_link',
        'url',
        'started_at',
        'ended_at',
        'user_id',
        'visibility'
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function describes()
    {
        return $this->hasMany(Describe::class)->orderBy('order', 'asc');
    }

    public function scopeSearch($query, $request)
    {
        return $query->when($request->name, function ($q, $name) {
            return $q->where('name', 'like', '%' . $name . '%');
        })->when($request->owner_name, function ($q, $owner_name) {
            return $q->whereRelation('user', 'name', 'like', '%' . $owner_name . '%');
        })->when($request->user_id, function ($q, $user_id) {
            return $q->where('user_id', $user_id);
        });
    }
}

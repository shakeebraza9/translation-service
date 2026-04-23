<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'url',
        'github_link',
        'technologies',
        'image',
        'database',
        'framework',
        'description',
        'video',
        'date',
        'developed_by',
        'author'
    ];

    // 🔗 One Project → Many Gallery Images
    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class, 'project_id');
    }
}

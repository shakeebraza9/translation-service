<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $table = 'project_gallery';

    protected $fillable = [
        'project_id',
        'image',
        'title'
    ];

    // 🔗 Each Gallery belongs to a Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
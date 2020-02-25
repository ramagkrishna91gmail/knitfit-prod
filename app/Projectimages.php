<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Projectimages extends Model
{
    protected $table = 'projects_images';

    function projects(){
        return $this->belongsTo(Project::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use UuidModel;
    protected $table = 'projects';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}

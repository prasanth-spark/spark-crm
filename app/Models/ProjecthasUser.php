<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjecthasUser extends Model
{
    use UuidModel;
    use SoftDeletes;
    protected $table = 'project_user';
    protected $guarded = [];

}

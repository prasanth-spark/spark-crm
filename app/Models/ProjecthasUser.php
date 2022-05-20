<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;


class ProjecthasUser extends Model
{
    use UuidModel;
    protected $table = 'project_user';
    protected $guarded = [];

}

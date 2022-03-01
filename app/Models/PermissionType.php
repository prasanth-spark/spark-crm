<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    use HasFactory;
    protected $table = 'permission_types';
    protected $guarded = [];

    public function permissionTypes()
    {
        return $this->hasOne(LeaveRequest::class, 'permission_type_id', 'id');
    }
}

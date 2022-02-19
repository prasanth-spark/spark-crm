<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = [];

    public function roleType()
    {
        return $this->hasmany(User::class, 'role_id', 'id');
    }

    public function role()
    {
        return $this->hasmany(UserDetails::class, 'role_id', 'id');
    }
}

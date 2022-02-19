<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $guarded = [];

    public function team()
    {
        return $this->hasmany(User::class, 'role_id', 'id');
    }

    public function teamType()
    {
        return $this->hasmany(UserDetails::class, 'role_id', 'id');
    }
}

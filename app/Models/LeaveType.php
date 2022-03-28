<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $table = 'leave_types';
    protected $guarded = [];

    public function leaveType()
    {
        return $this->hasOne(LeaveRequest::class,'leave_type_id','id');
    }
}

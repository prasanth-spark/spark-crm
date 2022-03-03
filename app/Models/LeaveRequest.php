<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
  use HasFactory;
  protected $table = 'leave_requests';
  protected $guarded = [];

  public function leaverequest()
  {
    return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
  }
  public function permissionType()
  {
      return $this->belongsTo(PermissionType::class, 'permission_type_id', 'id');
  }

  public function userAttendance(){
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function leaverequestUser()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function leaveToUserDetails(){
         
    return $this->belongsTo(UserDetails::class,'user_id','user_id');
}

}

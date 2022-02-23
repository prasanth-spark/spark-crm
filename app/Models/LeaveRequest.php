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
}

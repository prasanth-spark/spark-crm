<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $guarded = [];

    public function attendanceToUser(){

     return $this->belongsTo(User::class,'user_id','id');

     }


     public function attendanceToUserDetails(){
         
        return $this->belongsTo(UserDetails::class,'user_id','user_id');
    }

}

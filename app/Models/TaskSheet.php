<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSheet extends Model
{
    protected $table='task_sheets';
    protected $guarded = [];


    public function taskToUser(){
        return $this->belongsTo(User::class,'user_id','id');
   } 

   public function taskToUserDetails(){
    return $this->hasOne(UserDetails::class,'user_id','user_id');
}
}

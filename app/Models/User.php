<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Helper\UuidModel;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use UuidModel;
    protected $fillable = [
        'name', 'email', 'status','password', 'role_id', 'team_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The getter that return accessible URL for user photo.
     *
     * @var array
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->foto !== null) {
            return url('media/user/' . $this->id . '/' . $this->foto);
        } else {
            return url('media-example/no-image.png');
        }
    }

    public function roleToUser()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }


    public function teamToUser()
    {
        return $this->belongsTo(TeamModel::class, 'team_id', 'id');
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'id');
    }

    public function getSingleUser($id)
    {
        return $this->where('id', $id)->first();
    }

    public function userTeamId()
    {
        return $this->hasMany(UserDetails::class, 'user_id', 'id');
    }
    public function userAttendanceId(){

        return $this->hasOne(Attendance::class, 'user_id', 'id');
    }
    public function userTask(){

        return $this->hasMany(TaskSheet::class, 'user_id', 'id');
    }
    public function userLeaveRequest(){
        return $this->hasMany(LeaveRequest::class, 'user_id', 'id');
    }
}

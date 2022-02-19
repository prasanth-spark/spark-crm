<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{
    use UuidModel, SoftDeletes;

    protected $table = 'user_details';

    protected $guarded = [];


    public function bankNameToEmployee()
    {
        return $this->belongsTo(BankDetails::class, 'bank_id', 'id');
    }

    public function accountTypeToEmployee()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id', 'id');
    }



    public function roleToUserDetails()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }


    public function teamToUserDetails()
    {
        return $this->belongsTo(TeamModel::class, 'team_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

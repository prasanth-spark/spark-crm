<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

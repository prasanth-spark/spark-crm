<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;


class Employee extends Model
{
    use UuidModel;
    protected $table='employees';
    protected $guarded = [];

    public function bankNameToEmployee()
    {
        return $this->belongsTo(BankDetails::class,'bank_id','id');
    }
    public function accountTypeToEmployee()
    {
        return $this->belongsTo(AccountType::class,'account_type_id','id');
    }
}

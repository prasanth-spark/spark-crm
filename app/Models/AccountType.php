<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;

class AccountType extends Model
{
    use UuidModel;
    protected $table = 'account_types';
    protected $guarded = [];

    public function accountType()
    {
        return $this->hasone(UserDetails::class, 'account_type_id', 'id');
    }
}

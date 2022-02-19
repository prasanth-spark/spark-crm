<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\UuidModel;

class BankDetails extends Model
{
    use UuidModel;
    protected $table = 'bank_details';
    protected $guarded = [];

    public function bankName()
    {
        return $this->hasone(UserDetails::class, 'bank_id', 'id');
    }
}

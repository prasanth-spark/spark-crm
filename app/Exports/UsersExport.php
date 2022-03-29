<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [];
    }
    public function headings(): array
    {
        return [
        'name',
        'email',
        'status',
        'password',
        'role_id',
        'team_id',
        'user_id',
        'role_id',
        'team_id',
        'employee_id',
        'father_name',
        'mother_name',
        'phone_number',
        'emergency_contact_number',
        'official_email',
        'joined_date',
        'home_address',
        'date_of_birth',
        'blood_group',
        'pan_number',
        'aadhar_number',
        'bank_id',
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'branch_name',
        'account_type_id',
        
        ];
    }
  
}

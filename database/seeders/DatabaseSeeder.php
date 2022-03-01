<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(BankNameSeeder::class);
        $this->call(AccountTypeSeeder::class);
        $this->call(UserSeeder::class); 
        $this->call(LeaveTypeSeeder::class);
        $this->call(TaskStatusSeeder::class);
        $this->call(PermissionTypeSeeder::class);
    }
}

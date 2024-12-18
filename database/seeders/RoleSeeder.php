<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            "name"=> "Administrator",
            "description"=> "Administrator role",
        ]);
        Role::create([
            "name"=> "Accountant",
            "description"=> "Accountant Role",
            ]);
    }
}

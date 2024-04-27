<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::insert(
            [
                [
                    'id' => 1,
                    'role' => 'Admin'
                ],
                [
                    'id' => 2,
                    'role' => 'Editor'
                ]
            ]
        );
    }
}

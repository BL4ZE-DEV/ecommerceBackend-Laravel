<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'roleId' => Str::uuid(),
            'name' => 'seller',
        ]);

        DB::table('roles')->insert([
            'roleId' => Str::uuid(),
            'name' => 'customer',
        ]);
        // In a seeder class like RoleSeeder


    }
}

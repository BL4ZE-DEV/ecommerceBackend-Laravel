<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'name' => 'Seller',
        ]);

        DB::table('roles')->insert([
            'roleId' => Str::uuid(),
            'name' => 'Customer',
        ]);
        
        DB::table('roles')->insert([
            'roleId' => Str::uuid(),
            'name' => 'Admin'
        ]);

        DB::table('admins')->insert([
            'adminId' => Str::uuid(),
            'name' => 'Ayedun Sultan',
            'email' => 'ayedunsultan1@gmail.com',
            'password' => Hash::make('password1!'),
            'role' => Role::where('name' , 'Admin')->first()->name,
            'roleId' => Role::where('name' , 'Admin')->first()->roleId
        ]);

    }
}

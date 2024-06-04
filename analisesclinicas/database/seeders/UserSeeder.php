<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'recepcionist']);
        Role::create(['name' => 'technician']);
        Role::create(['name' => 'patient']);


        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'cpf' => '618.837.920-29',
            'password' => Hash::make('admin123')
        ])->assignRole('admin');

    }
}

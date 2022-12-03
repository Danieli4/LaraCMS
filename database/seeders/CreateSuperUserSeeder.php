<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateSuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = User::create([
            'email' => 'daniel58912007@gmail.com',
            'name'=>'Admin',
            'password'=> Hash::make('1234567890'),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),

        ]);
        Role::create([
            'name'=>'super-user',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        $superUser->assignRole('super-user');
    }
}
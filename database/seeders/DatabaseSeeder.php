<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        $roles = [
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'client', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('roles')->insert($roles);

        // Obtener IDs de roles
        $adminRoleId = DB::table('roles')->where('name', 'admin')->first()->id;
        $clientRoleId = DB::table('roles')->where('name', 'client')->first()->id;

        // Crear usuario admin
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Sebastian Rodriguez',
            'email' => 'practica1@gmail.com',
            'password' => Hash::make('123123'),
            'role_id' => $adminRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear datos personales para el admin
        DB::table('personal_data')->insert([
            'user_id' => $adminId,
            'age' => 25,
            'gender' => 'male',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Faker para datos aleatorios
        $faker = Faker::create();

        // Crear 50 clientes
        for ($i = 0; $i < 500; $i++) {
            $gender = $faker->randomElement(['male', 'female']);

            // Crear usuario
            $userId = DB::table('users')->insertGetId([
                'name' => $faker->name($gender),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role_id' => $clientRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crear datos personales para el usuario
            DB::table('personal_data')->insert([
                'user_id' => $userId,
                'age' => $faker->numberBetween(10, 26),
                'gender' => $gender,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

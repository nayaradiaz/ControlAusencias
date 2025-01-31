<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener los roles existentes
        $adminRole = Role::where('name', 'Admin')->first();
        $professorRole = Role::where('name', 'Profesor')->first();

        // Crear el usuario Admin solo si no existe
        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com', // Evita duplicados por email
        ], [
            'name' => 'Admin',
            'surnames' => 'Administrator',
            'password' => Hash::make('qwerty-1234'),
            'department_id' => 1,
        ]);

        // Asignar el rol de Admin
        if ($adminRole) {
            $adminUser->assignRole($adminRole);
        }

        // Crear un usuario regular solo si no existe
        $usuario = User::firstOrCreate([
            'email' => 'usuario@example.com', // Evita duplicados por email
        ], [
            'name' => 'Usuario',
            'surnames' => 'Usuario',
            'password' => Hash::make('qwerty-1234'), // Contraseña predeterminada
            'department_id' => 1,
        ]);

        // Asignar el rol de Profesor
        if ($professorRole) {
            $usuario->assignRole($professorRole);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear departamentos
        Department::create([
            'name' => 'Inglés',
        ]);

        Department::create([
            'name' => 'Informática',
        ]);

        Department::create([
            'name' => 'Matemáticas',
        ]);

        Department::create([
            'name' => 'Física',
        ]);

        Department::create([
            'name' => 'Historia',
        ]);
    }
}
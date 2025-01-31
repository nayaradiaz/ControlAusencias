<?php

namespace App\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithFileUploads; // Para cargar archivos
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class FormsUsers extends Component
{
    use WithFileUploads;

    
    public $csv_file; // Variable para almacenar el archivo CSV
    public $name;
    public $surnames;
    public $email;
    public $department_id; 
    public $departments;
    public $test = 'hola';
    
    public function render()
    {
        return view('livewire.forms-users');
    }

    public function mount()
    {
        $this->departments = Department::all(); 
    }
    public function resetInputFields(){

        $this->name = '';
        $this->surnames = '';
        $this->email = '';
        
    
    }
    public function registerUser()
    {
        // Validación
        $this->validate([
            'name' => 'required|string|max:255',
            'surnames' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $this->name,
            'surnames' => $this->surnames,
            'email' => $this->email,
            'department_id' => $this->department_id,
        ]);

        // Asignar el rol
        $role = Role::findByName('Profesor');
        $user->assignRole($role);

        // Notificar al usuario que se registró con éxito
        session()->flash('success', 'Usuario registrado correctamente.');
        $this->resetInputFields(); 
    }

    

    // Función para manejar la carga de CSV
    public function uploadCsv()
    {
        $this->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $path = $this->csv_file->getRealPath();
        $data = array_map('str_getcsv', file($path)); // Leer el archivo CSV
        $header = array_shift($data); // Obtener el encabezado del archivo

        foreach ($data as $row) {
            $rowData = array_combine($header, $row); // Combinar los encabezados con los datos

            // Verificar si el usuario ya existe
            $user = User::where('email', $rowData['email'])->first();
            if (!$user) {
                $user = User::create([
                    'name' => $rowData['name'],
                    'surnames' => $rowData['surnames'],
                    'email' => $rowData['email'],
                    'department_id' => $rowData['department_id'],

                ]);

                // Asignar rol de Profesor
                $role = Role::where('name', 'Profesor')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }
        }

        session()->flash('success', 'Archivo CSV procesado correctamente.');
    }
}
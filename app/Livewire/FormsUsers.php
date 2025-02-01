<?php

namespace App\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Spatie\Permission\Models\Role;

class FormsUsers extends Component
{
    use WithFileUploads;

    public $csv_file;
    public $name;
    public $surnames;
    public $email;
    public $department_id;
    public $departments;

    protected $rules = [
        'name' => 'required|string|max:255',
        'surnames' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'department_id' => 'required|exists:departments,id',
    ];

    protected function messages()
    {
        return [
            'name.required' => '⚠ El nombre es obligatorio.',
            'name.max' => '⚠ El nombre no puede superar los 255 caracteres.',
            'surnames.required' => '⚠ Los apellidos son obligatorios.',
            'surnames.max' => '⚠ Los apellidos no pueden superar los 255 caracteres.',
            'email.required' => '⚠ El correo electrónico es obligatorio.',
            'email.email' => '⚠ Ingresa un correo electrónico válido.',
            'email.unique' => '⚠ Este correo ya está registrado.',
            'department_id.required' => '⚠ Debes seleccionar un departamento.',
            'department_id.exists' => '⚠ El departamento seleccionado no es válido.',
            'csv_file.required' => '⚠ Debes subir un archivo CSV.',
            'csv_file.mimes' => '⚠ El archivo debe ser de tipo CSV o TXT.',
            'csv_file.max' => '⚠ El archivo no debe superar los 2MB.',
        ];
    }

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->surnames = '';
        $this->email = '';
        $this->department_id = '';
    }

    public function registerUser()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'surnames' => $this->surnames,
            'email' => $this->email,
            'department_id' => $this->department_id,
        ]);

        $role = Role::where('name', 'Profesor')->first();
        if ($role) {
            $user->assignRole($role);
        }

        session()->flash('success', '✅ Usuario registrado correctamente.');
        $this->resetInputFields();
    }

    public function uploadCsv()
    {
        $this->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $path = $this->csv_file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        foreach ($data as $row) {
            $rowData = array_combine($header, $row);

            if (!User::where('email', $rowData['email'])->exists()) {
                $user = User::create([
                    'name' => $rowData['name'],
                    'surnames' => $rowData['surnames'],
                    'email' => $rowData['email'],
                    'department_id' => $rowData['department_id'],
                ]);

                $role = Role::where('name', 'Profesor')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }
        }

        session()->flash('success', '✅ Archivo CSV procesado correctamente.');
        $this->csv_file = null;
    }

    public function render()
    {
        return view('livewire.forms-users');
    }
}

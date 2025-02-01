<?php

namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FormsAbsences extends Component
{
    public $departments, $timeSlots, $absenceId, $timeSlot, $comments, $date, $turnoHora, $users, $userId, $department_id;

 

    protected function messages()
    {
        return [
            'userId.required' => '⚠ Debes seleccionar un usuario.',
            'userId.exists' => '⚠ El usuario seleccionado no es válido.',
            'timeSlot.required' => '⚠ Selecciona un turno.',
            'timeSlot.in' => '⚠ El turno seleccionado no es válido.',
            'comments.max' => '⚠ El comentario no puede superar los 500 caracteres.',
            'date.required' => '⚠ La fecha es obligatoria.',
            'date.date' => '⚠ La fecha no es válida.',
        ];
    }

    public function mount()
    {
        $this->users = User::all();
        $this->departments = Department::all();  // Cargar departamentos
        $this->timeSlots = $this->getTimeSlots();
        $this->date = Carbon::today()->toDateString();
        $this->turnoHora = null;
    }

    private function getTimeSlots()
    {
        $timeSlots =  [
            'mañana_1' => '08:00 - 08:55',
            'mañana_2' => '08:55 - 09:50',
            'mañana_3' => '09:50 - 10:45',
            'recreo_1' => '10:45 - 11:15',
            'mañana_4' => '11:15 - 12:10',
            'mañana_5' => '12:10 - 13:05',
            'mañana_6' => '13:05 - 14:00',
            'tarde_1' => '14:00 - 14:55',
            'tarde_2' => '14:55 - 15:45',
            'tarde_3' => '15:45 - 16:45',
            'recreo_2' => '16:45 - 17:15',
            'tarde_4' => '17:15 - 18:10',
            'tarde_5' => '18:10 - 19:05',
            'tarde_6' => '19:05 - 20:00',
        ];
        // Si hoy es martes, cambia los horarios
        if (Carbon::now()->isTuesday()) {
            $timeSlots = [
                'mañana_1' => '08:00 - 08:55',
                'mañana_2' => '08:55 - 09:50',
                'mañana_3' => '09:50 - 10:45',
                'recreo_1' => '10:45 - 11:15',
                'mañana_4' => '11:15 - 12:10',
                'mañana_5' => '12:10 - 13:05',
                'mañana_6' => '13:05 - 14:00',
                'tarde_1' => '15:00 - 15:45',
                'tarde_2' => '15:45 - 16:30',
                'tarde_3' => '16:30 - 17:15',
                'recreo_2' => '17:15 - 17:45',
                'tarde_4' => '17:45 - 18:30',
                'tarde_5' => '18:30 - 19:15',
                'tarde_6' => '19:15 - 20:00',
            ];
        }
        return $timeSlots;
    }

    public function updatedTimeSlot($value)
    {
        $this->turnoHora = $this->getTimeSlots()[$value] ?? '';
    }

    public function store()
    {
        // Verificar el valor del departamento
        // dd($this->department_id);  // Muestra el valor del departamento en la consola
    
        $this->validate([
            'userId' => 'required|exists:users,id',
            'timeSlot' => 'required|in:mañana_1,mañana_2,mañana_3,recreo_1,mañana_4,mañana_5,mañana_6,tarde_1,tarde_2,tarde_3,recreo_2,tarde_4,tarde_5,tarde_6',
            'comments' => 'nullable|string|max:500',
            'date' => 'required|date',
            'department_id' => 'nullable|exists:departments,id',
        ]);
    
        Absence::create([
            'user_id' => $this->userId,
            'date' => $this->date,
            'time_slot' => $this->timeSlot,
            'comments' => $this->comments,
            'department_id' => $this->department_id,  // Este valor debe estar aquí
        ]);
    
        session()->flash('message', '✅ Ausencia registrada exitosamente.');
        $this->resetForm();
    }
    
    public function resetForm()
    {
        $this->userId = null;
        $this->timeSlot = null;
        $this->comments = null;
        $this->turnoHora = null;
    }

    public function getAbsencesForToday()
    {
        return Absence::where('date', $this->date)->get();
    }

    public function render()
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403);
        }

        $absences = $this->getAbsencesForToday();
        $departments = Department::all();  // Cargar los departamentos

        return view('livewire.forms-absences', compact('absences', 'departments'));  // Pasar $departments a la vista
    }
}

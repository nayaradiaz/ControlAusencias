<?php

namespace App\Livewire;

use App\Mail\MailerCreateAbsences;
use App\Models\Absence;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserAbsences extends Component
{
    public $departments, $timeSlots, $absenceId, $timeSlot, $comments, $date, $turnoHora, $userId, $department_id;

    protected function messages()
    {
        return [
            'userId.required' => '⚠ Debes seleccionar un usuario.',
            'userId.exists' => '⚠ El usuario seleccionado no es válido.',
            'timeSlot.required' => '⚠ Selecciona un turno.',
            'timeSlot.in' => '⚠ El turno seleccionado no es válido.',
            'comments.max' => '⚠ El comentario no puede superar los 250 caracteres.',
            'department_id.exists' => '⚠ El departamento seleccionado no es válido.',
            'department_id.required' => '⚠ Debes seleccionar un departamento.',
        ];
    }

    public function mount()
    {
        // Obtener todos los usuarios
        $this->userId = Auth::id();
        $this->departments = Department::all();  // Cargar departamentos
        $this->timeSlots = $this->getTimeSlots();
        $this->date = Carbon::today()->toDateString();
        $this->turnoHora = null;
        $this->department_id = null; // Asegúrate de inicializar la propiedad
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
    // Validación
    $this->validate([
        'userId' => 'required|exists:users,id',
        'timeSlot' => 'required|in:mañana_1,mañana_2,mañana_3,recreo_1,mañana_4,mañana_5,mañana_6,tarde_1,tarde_2,tarde_3,recreo_2,tarde_4,tarde_5,tarde_6',
        'comments' => 'nullable|string|max:250',
        'date' => 'required|date',
        'department_id' => 'required|exists:departments,id',
    ]);

  
    // Crear la ausencia
    Absence::create([
        'user_id' => $this->userId,
        'date' => $this->date,
        'comments' => $this->comments,
        'department_id' => $this->department_id,
        'time_slot' => $this->timeSlot,
    ]);
    $absenceData = [
        'user' => User::find($this->userId)->name,
        'department' => Department::find($this->department_id)->name ?? 'No asignado',
        'date' => $this->date,
        'timeSlot' => $this->getTimeSlots()[$this->timeSlot],
        'comments' => $this->comments ?? 'Ninguno',
    ];
    Mail::to('nayinformatica1smr.1@gmail.com')->send(new MailerCreateAbsences($absenceData));


    session()->flash('message', '✅ Ausencia registrada exitosamente.');
    $this->resetForm();
}



    public function resetForm()
    {
        $this->userId = null;
        $this->timeSlot = null;
        $this->comments = null;
        $this->department_id = null;
        $this->turnoHora = null;
    }

    public function getAbsencesForToday()
    {
        return Absence::where('date', $this->date)
                      ->where('user_id', Auth::id()) // Filtrar por usuario autenticado
                      ->get();
    }
    

    public function render()
    {
        $userId = Auth::id();

        $absences = $this->getAbsencesForToday();
        $departments = Department::all();  // Cargar los departamentos

        return view('livewire.user-absences', compact('absences', 'departments', 'userId'));  // Pasar $users a la vista
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Absence;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;

class TableAbsences extends Component
{
    public $absences, $absenceId, $userId, $timeSlot, $date, $comments, $departments,$department_id;
    public $editMode = false;

    public function mount()
    {
        $this->departments = Department::all();
        $this->loadAbsences();
    }
    public function loadAbsences()
    {
        $this->absences = Absence::with('user', 'department') // Cargar la relación con el departamento
            ->orderBy('date', 'desc')
            ->get();
    }

    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        
        $this->absenceId = $absence->id;
        $this->userId = $absence->user_id;
        $this->timeSlot = $absence->time_slot;
        $this->date = $absence->date;
        $this->comments = $absence->comments;
        $this->department_id = $absence->department_id; // Asignar el departamento
    
        $this->editMode = true;
    }

    public function update()
{
    $this->validate([
        'userId' => 'required|exists:users,id',
        'timeSlot' => 'required',
        'date' => 'required|date',
        'comments' => 'nullable|string|max:500',
        'department_id' => 'nullable|exists:departments,id', // Validación para el departamento
    ]);

    $absence = Absence::findOrFail($this->absenceId);
    $absence->update([
        'user_id' => $this->userId,
        'time_slot' => $this->timeSlot,
        'date' => $this->date,
        'comments' => $this->comments,
        'department_id' => $this->department_id, // Actualización del departamento
    ]);

    session()->flash('success', 'Ausencia actualizada correctamente.');
    $this->editMode = false;
    $this->loadAbsences();
}


    public function delete($id)
    {
        $absence = Absence::findOrFail($id);
        // if ($absence->created_at->diffInMinutes(now()) > 10) {
        //     session()->flash('error', 'No puedes eliminar la ausencia después de 10 minutos.');
        //     return;
        // }

        $absence->delete();
        session()->flash('success', 'Ausencia eliminada correctamente.');
        $this->loadAbsences();
    }

    public function cancelEdit()
    {
        $this->editMode = false;
    }
    public function getTimeSlotLabel($timeSlot)
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
        return $timeSlots[$timeSlot] ?? 'Horario no disponible';     

    }
    public function render()
    {
        return view('livewire.table-absences', [
            'departments' => $this->departments,  // Pasar la variable a la vista
        ]);
    }
}

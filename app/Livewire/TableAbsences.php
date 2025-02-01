<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Absence;
use App\Models\User;
use Carbon\Carbon;

class TableAbsences extends Component
{
    public $absences, $absenceId, $userId, $timeSlot, $date, $comments;
    public $editMode = false;

    public function mount()
    {
        $this->loadAbsences();
    }

    public function loadAbsences()
    {
        $this->absences = Absence::with('user')->orderBy('date', 'desc')->get();
    }

    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        if ($absence->created_at->diffInMinutes(now()) > 10) {
            session()->flash('error', 'No puedes editar la ausencia después de 10 minutos.');
            return;
        }

        $this->absenceId = $absence->id;
        $this->userId = $absence->user_id;
        $this->timeSlot = $absence->time_slot;
        $this->date = $absence->date;
        $this->comments = $absence->comments;

        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'userId' => 'required|exists:users,id',
            'timeSlot' => 'required',
            'date' => 'required|date',
            'comments' => 'nullable|string|max:500',
        ]);

        $absence = Absence::findOrFail($this->absenceId);
        $absence->update([
            'user_id' => $this->userId,
            'time_slot' => $this->timeSlot,
            'date' => $this->date,
            'comments' => $this->comments,
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

    public function render()
    {
        return view('livewire.table-absences');
    }
}

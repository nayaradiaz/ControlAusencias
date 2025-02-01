<?php



namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use Carbon\Carbon;
use Livewire\Component;

class AbsenceOverview extends Component
{
    public $date;
    public $timeSlot;
    public $absences;
    public $departments;
    public $timeSlotIndex;

    public function mount()
    {
        $this->date = Carbon::today();
        $this->timeSlotIndex = 0; // Iniciar con el primer intervalo de tiempo
        $this->loadAbsences();
        $this->departments = Department::all();
    }

    // Obtener los intervalos de tiempo
    private function getTimeSlots()
    {
        $timeSlots = [
            '08:00 - 08:55',
            '08:55 - 09:50',
            '09:50 - 10:45',
            '10:45 - 11:15',
            '11:15 - 12:10',
            '12:10 - 13:05',
            '13:05 - 14:00',
            '14:00 - 14:55',
            '14:55 - 15:45',
            '15:45 - 16:45',
            '16:45 - 17:15',
            '17:15 - 18:10',
            '18:10 - 19:05',
            '19:05 - 20:00',
        ];

        // Si es martes, los intervalos de tiempo cambian
        if (Carbon::now()->isTuesday()) {
            $timeSlots = [
                '08:00 - 08:55',
                '08:55 - 09:50',
                '09:50 - 10:45',
                '10:45 - 11:15',
                '11:15 - 12:10',
                '12:10 - 13:05',
                '13:05 - 14:00',
                '15:00 - 15:45',
                '15:45 - 16:30',
                '16:30 - 17:15',
                '17:15 - 17:45',
                '17:45 - 18:30',
                '18:30 - 19:15',
                '19:15 - 20:00',
            ];
        }

        return $timeSlots;
    }

    // Cargar las ausencias para el intervalo de tiempo y día actual
    public function loadAbsences()
    {
        $this->timeSlot = $this->getTimeSlots()[$this->timeSlotIndex]; // Obtener el intervalo de tiempo actual
        $this->absences = Absence::where('date', $this->date)
            ->where('time_slot', $this->timeSlot)
            ->get();
    }

    // Mover al siguiente intervalo de tiempo
    public function nextHour()
    {
        if ($this->timeSlotIndex < count($this->getTimeSlots()) - 1) {
            $this->timeSlotIndex++;
            $this->loadAbsences();
        }
    }

    // Mover al intervalo de tiempo anterior
    public function previousHour()
    {
        if ($this->timeSlotIndex > 0) {
            $this->timeSlotIndex--;
            $this->loadAbsences();
        }
    }

    // Mover al siguiente día
    public function nextDay()
    {
        $this->date->addDay();
        $this->loadAbsences();
    }

    // Mover al día anterior
    public function previousDay()
    {
        $this->date->subDay();
        $this->loadAbsences();
    }

    public function render()
    {
        return view('livewire.absence-overview');
    }
}

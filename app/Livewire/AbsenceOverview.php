<?php
namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Livewire\Component;

class AbsenceOverview extends Component
{
    public $date;
    public $timeSlot;
    public $absences;
    public $departments;

    public function mount()
    {
        $this->date = Carbon::today();
        $this->timeSlot = '08:00 - 08:55'; // Hora inicial
        $this->loadAbsences();
        $this->departments = Department::all();
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
    public function loadAbsences()
    {
        $this->absences = Absence::where('date', $this->date)
            ->where('time_slot', $this->timeSlot)
            ->get();
    }

    public function nextHour()
    {
        $this->date->addHour();
        $this->loadAbsences();
    }

    public function previousHour()
    {
        $this->date->subHour();
        $this->loadAbsences();
    }

    public function nextDay()
    {
        $this->date->addDay();
        $this->loadAbsences();
    }

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

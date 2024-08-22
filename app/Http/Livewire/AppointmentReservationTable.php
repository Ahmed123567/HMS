<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentReservationTable extends Component
{

    use WithPagination;

    public $query = '';
    
    public Employee $doctor;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ["query" => ['except' => ''], "page" => ['except' => 1]];

    public function updatingquery()
    {
        $this->resetPage(); 
    }

    public function render()
    {

        $reservations = $this->doctor?->reservatoins()
                        ->whereHas("patient")
                        ->search($this->query)
                        ->latest()
                        ->when(request("today") == 1, function ($q) {
                            return $q->today();
                        })->paginate(6);
        
        return view('livewire.appointment-reservation-table', compact("reservations"));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class MedicalProfileTable extends Component
{
    use WithPagination;

    public Patient $patient;

    public $query = '';
    
    protected $paginationTheme = 'bootstrap';


    public function updatingquery()
    {
        $this->resetPage();
    }    


    public function render()
    {
        return view('livewire.medical-profile-table', [
            "records" => $this->patient?->records()->search($this->query)->paginate(6)
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Activity;

class HistoriqueTable extends Component
{
    use WithPagination;

    #[On("activityAdded")]
    public function refreshHistorique() {
        $this->resetPage();
    }
    public function render()
    {
        $activities = Activity::latest()->paginate(10);
        return view('livewire.historique-table', ["activities" => $activities]);
    }
}

<?php

namespace App\Livewire\Contractors;

use App\Models\Contractor;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $contractors = Contractor::paginate();

        return view('livewire.contractor.index', compact('contractors'))
            ->with('i', $this->getPage() * $contractors->perPage());
    }

    public function delete(Contractor $contractor)
    {
        $contractor->delete();

        return $this->redirectRoute('contractors.index', navigate: true);
    }
}

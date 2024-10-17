<?php

namespace App\Livewire\Contractors;

use App\Livewire\Forms\ContractorForm;
use App\Models\Contractor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ContractorForm $form;

    public function mount(Contractor $contractor)
    {
        $this->form->setContractorModel($contractor);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.contractor.show', ['contractor' => $this->form->contractorModel]);
    }
}

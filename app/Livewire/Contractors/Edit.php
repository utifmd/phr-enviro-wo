<?php

namespace App\Livewire\Contractors;

use App\Livewire\Forms\ContractorForm;
use App\Models\Contractor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ContractorForm $form;

    public function mount(Contractor $contractor)
    {
        $this->form->setContractorModel($contractor);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('contractors.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.contractor.edit');
    }
}

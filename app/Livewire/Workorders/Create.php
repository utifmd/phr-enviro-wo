<?php

namespace App\Livewire\Workorders;

use App\Livewire\Actions\GetRouteName;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

class Create extends Component
{
    #[Layout('layouts.app')]
    public function render(): View
    {
        $routeName = new GetRouteName();
        $this->redirectRoute($routeName(), navigate: true);

        return view('livewire.workorders.create');
    }
}

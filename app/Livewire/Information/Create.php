<?php

namespace App\Livewire\Information;

use App\Livewire\Actions\GetStepAt;
use App\Livewire\Actions\UpdateUserCurrentPost;
use App\Livewire\Forms\InformationForm;
use App\Models\Information;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public InformationForm $form;
    private Authenticatable $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function mount(Information $information): void
    {
        $this->form->setInformationModel($information);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('information.index', navigate: true);
    }

    public function addInformationThenNextToOrder(): void
    {
        $updateUserCurrentPost = new UpdateUserCurrentPost();

        $this->form->store();
        $userCurrentPost = [
            'step_at' => Order::ROUTE_POS,
            'url' => Order::ROUTE_NAME . '.create'
        ];
        $updateUserCurrentPost(
            $this->user->getAuthIdentifier(), $userCurrentPost
        );
        session()->flash(
            'message', 'Information successfully submitted, please follow the next step!'
        );
        $this->redirectRoute('orders.create', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $stepAt = new GetStepAt();
        $stepAt = $stepAt(Information::ROUTE_POS, $this->user);

        return view(
            'livewire.information.create', compact('stepAt')
        );
    }
}

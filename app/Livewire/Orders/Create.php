<?php

namespace App\Livewire\Orders;

use App\Livewire\Actions\GetStepAt;
use App\Livewire\Actions\UpdateUserCurrentPost;
use App\Livewire\Forms\OrderForm;
use App\Models\Order;
use App\Models\TripPlan;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public OrderForm $form;
    private Authenticatable $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function mount(Order $order)
    {
        $this->form->setOrderModel($order);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('orders.index', navigate: true);
    }

    public function addOrderThenNextToTripPlan(): void
    {
        $updateUserCurrentPost = new UpdateUserCurrentPost();
        $this->form->store();

        $userCurrentPost = [
            'step_at' => TripPlan::ROUTE_POS,
            'url' => TripPlan::ROUTE_NAME . '.create'
        ];
        $updateUserCurrentPost(
            $this->user->getAuthIdentifier(), $userCurrentPost
        );
        session()->flash(
            'message', 'Detail Orders successfully submitted, please follow the next step!'
        );
        $this->redirectRoute('orders.create', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $stepAt = new GetStepAt();
        $stepAt = $stepAt(Order::ROUTE_POS, $this->user);

        return view(
            'livewire.order.create', compact('stepAt')
        );
    }
}

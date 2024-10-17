<?php

namespace App\Livewire\TripPlans;

use App\Livewire\Actions\GetStepAt;
use App\Livewire\Actions\RemoveUserCurrentPost;
use App\Livewire\Actions\UpdateUserCurrentPost;
use App\Livewire\Forms\TripPlanForm;
use App\Models\Order;
use App\Models\TripPlan;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public TripPlanForm $form;
    private Authenticatable $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function mount(TripPlan $tripPlan)
    {
        $this->form->setTripPlanModel($tripPlan);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('trip-plans.index', navigate: true);
    }

    public function addTripPlanThenFinish(): void
    {
        $removeUserCurrentPost = new RemoveUserCurrentPost();

        $this->form->store();
        $removeUserCurrentPost($this->user->getAuthIdentifier());
        session()->flash(
            'message', 'Detail Orders successfully submitted, please follow the next step!'
        );
        $this->redirectRoute('posts.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $stepAt = new GetStepAt();
        $stepAt = $stepAt(TripPlan::ROUTE_POS);

        return view(
            'livewire.trip-plan.create', compact('stepAt')
        );
    }
}

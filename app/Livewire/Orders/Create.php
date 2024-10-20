<?php

namespace App\Livewire\Orders;

use App\Livewire\Actions\GetStep;
use App\Livewire\Actions\UpdateUserCurrentPost;
use App\Livewire\Forms\OrderForm;
use App\Models\Order;
use App\Models\TripPlan;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public OrderForm $form;
    private Authenticatable $user;
    private GetStep $getStep;

    public array $statusSuggest = ['Booked', 'Done'];
    public array $uomSuggest = ['Loads'];
    public array $yardSuggest = ['Green Yard', 'WDR TRP Duri'];

    public function __construct()
    {
        $this->user = auth()->user();
        $this->getStep = new GetStep($this->user);
    }

    public function mount(Order $order): void
    {
        $currentPost = $this->user->currentPost ?? null;
        if (!$currentPost) return;

        $postId = $currentPost->post_id;
        $build = Order::query()
            ->where('post_id', '=', $postId)
            ->get();

        $orderModel = $build->isNotEmpty()
            ? $build->first()
            : $order;

        $orderModel->post_id = $postId;
        Log::debug(json_encode($orderModel));
        $this->form->setOrderModel($orderModel);
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
            'steps' => '0;1;2;3',
            'step_at' => TripPlan::ROUTE_POS,
            'url' => TripPlan::ROUTE_NAME . '.create'
        ];
        $updateUserCurrentPost(
            $this->user->getAuthIdentifier(), $userCurrentPost
        );
        session()->flash(
            'message', 'Detail Orders successfully submitted, please follow the next step!'
        );
        $this->redirectRoute(TripPlan::ROUTE_NAME.'.create', navigate: true);
    }

    public function onStatusSelected(string $text): void
    {
        $this->form->setStatus($text);
        $this->statusSuggest = array_filter(
            $this->statusSuggest, function($item) use ($text) {
            return $item !== $text;
        });
    }

    public function onUomSelected(string $text): void
    {
        $this->form->setUom($text);
        $this->uomSuggest = array_filter(
            $this->uomSuggest, function($item) use ($text) {
            return $item !== $text;
        });
    }

    public function onYardSelected(string $text): void
    {
        $this->form->setYard($text);
        $this->yardSuggest = array_filter(
            $this->yardSuggest, function($item) use ($text) {
            return $item !== $text;
        });
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $steps = $this->getStep->getSteps();
        $stepAt = $this->getStep->getStepAt();
        $disabled = in_array(Order::ROUTE_POS, $steps) && $stepAt != Order::ROUTE_POS;

        return view('livewire.order.create', compact(
            'steps', 'stepAt', 'disabled'
        ));
    }
}

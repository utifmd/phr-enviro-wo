<?php

namespace App\Livewire\TripPlans;

use App\Models\Order;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Confirm extends Component
{
    private Authenticatable $user;
    public array $tripPlan = [];

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function mount(): void
    {
        $currentPost = $this->user->currentPost ?? null;
        if (!$currentPost) return;

        $tripOrders = $this->getTripOrders($currentPost->post_id);
        if($tripOrders->isEmpty()) return;

        $this->setTripPlan($tripOrders->first());
    }

    private function getTripOrders(string $postId): Collection
    {
        return Order::query()
            ->select('yard', 'pick_up_from', 'destination', 'trip')
            ->where('post_id', '=', $postId)
            ->get();
    }

    private function setTripPlan($tripOrder): void
    {
        $tripTimes = $tripOrder->trip +2;
        for ($i = 0; $i < $tripTimes; $i++) {
            $batch = [];
            $batch['no'] = $i + 1;
            switch ($i) {
                case 0:
                    $batch['trip_type'] = 'Empty Trip';
                    $batch['start_from'] = $tripOrder->yard;
                    $batch['finish_to'] = $tripOrder->pick_up_from;
                    break;
                case ($tripTimes -1):
                    $batch['trip_type'] = 'Back To Base';
                    $batch['start_from'] = $tripOrder->destination;
                    $batch['finish_to'] = $tripOrder->yard;
                    break;
                default:
                    $batch['trip_type'] = 'Loaded Trip';
                    $batch['start_from'] = $tripOrder->pick_up_from;
                    $batch['finish_to'] = $tripOrder->destination;
                    break;
            }
            $this->tripPlan[$i] = $batch;
        }
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.information.confirm', [
            'tripPlan' => $this->tripPlan
        ]);
    }
}

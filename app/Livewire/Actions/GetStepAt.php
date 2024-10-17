<?php

namespace App\Livewire\Actions;

use App\Models\User;

class GetStepAt
{
    public function __invoke(int $route, ?User $user = null): int
    {
        $currentUser = $user ?? \auth()->user();
        $currentPost = $currentUser->currentPost ?? false;
        // $stepAt = $currentUser->step_at ?? 0;
        if (!$currentPost) return 0;

        // if (!$stepAt) return 0;
        /*$doneSteps = explode(";", $stepAt);
        return in_array($route, $doneSteps);*/

        return $currentPost->step_at ?? 0; //$stepAt;
    }
}

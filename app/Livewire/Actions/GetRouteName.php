<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;

class GetRouteName
{
    public function __invoke(): string
    {
        $currentUser = Auth::user(); // User::query()->find(Auth::id());

        if ($currentPost = $currentUser->currentPost ?? false) {
            return $currentPost->url;
        }
        return 'posts.index';
    }
}

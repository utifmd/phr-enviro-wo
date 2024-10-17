<?php

namespace App\Livewire\Posts;

use App\Livewire\Actions\GetStepAt;
use App\Livewire\Forms\PostForm;
use App\Models\Post;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public PostForm $form;

    public function mount(Post $post): void
    {
        $this->form->setPostModel($post);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('posts.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $stepAt = new GetStepAt();
        $stepAt = $stepAt(Post::ROUTE_POS);

        return view(
            'livewire.post.create', compact('stepAt')
        );
    }
}

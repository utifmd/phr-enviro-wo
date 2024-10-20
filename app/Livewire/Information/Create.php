<?php

namespace App\Livewire\Information;

use App\Livewire\Actions\GetStep;
use App\Livewire\Actions\UpdateUserCurrentPost;
use App\Livewire\Forms\InformationForm;
use App\Models\Information;
use App\Models\Order;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

/* TODO:
 * - print the data with qrcode
 * - create operator table relation with vehicle, and driver
 * */
class Create extends Component
{
    public InformationForm $form;
    private Authenticatable $user;
    private GetStep $getStep;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->getStep = new GetStep($this->user);
    }

    public function mount(Information $information): void
    {
        $currentPost = $this->user->currentPost ?? null;
        if (!$currentPost) return;

        $postId = $currentPost->post_id;
        $build = Information::query()
            ->where('post_id', '=', $postId)
            ->get();

        $informationModel = $build->isNotEmpty()
            ? $build->first()
            : $information;

        $informationModel->post_id = $postId;
        $this->form->setInformationModel($informationModel);
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
            'steps' => '0;1;2',
            'step_at' => Order::ROUTE_POS,
            'url' => Order::ROUTE_NAME . '.create'
        ];
        $updateUserCurrentPost(
            $this->user->getAuthIdentifier(), $userCurrentPost
        );
        session()->flash(
            'message', 'Information successfully submitted, please follow the next step!'
        );
        $this->redirectRoute(Order::ROUTE_NAME.'.create', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $steps = $this->getStep->getSteps();
        $stepAt = $this->getStep->getStepAt();
        $disabled = in_array(Information::ROUTE_POS, $steps) && $stepAt != Information::ROUTE_POS;

        return view('livewire.information.create', compact(
            'steps', 'stepAt', 'disabled'
        ));
    }
}

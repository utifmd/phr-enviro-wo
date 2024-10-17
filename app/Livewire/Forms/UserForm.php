<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $userModel;

    public $name = '';
    public $email = '';
    public $username = '';
    public $role = '';

    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'email' => 'required|string',
			'username' => 'required|string',
			'role' => 'required|string',
        ];
    }

    public function setUserModel(User $userModel): void
    {
        $this->userModel = $userModel;

        $this->name = $this->userModel->name;
        $this->email = $this->userModel->email;
        $this->username = $this->userModel->username;
        $this->role = $this->userModel->role;
    }

    public function store(): void
    {
        $this->userModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->userModel->update($this->validate());

        $this->reset();
    }
}

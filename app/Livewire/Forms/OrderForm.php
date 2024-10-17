<?php

namespace App\Livewire\Forms;

use App\Models\Order;
use Livewire\Form;

class OrderForm extends Form
{
    public ?Order $orderModel;
    
    public $unit = '';
    public $description = '';
    public $req_qty = '';
    public $rem_qty = '';
    public $sch_qty = '';
    public $uom = '';
    public $required_date = '';
    public $pick_up_from = '';
    public $destination = '';
    public $wr_number = '';
    public $rig_name = '';
    public $pic = '';
    public $change = '';
    public $post_id = '';

    public function rules(): array
    {
        return [
			'unit' => 'string',
			'description' => 'string',
			'uom' => 'string',
			'pick_up_from' => 'string',
			'destination' => 'string',
			'wr_number' => 'string',
			'rig_name' => 'string',
			'pic' => 'string',
			'change' => 'string',
			'post_id' => 'required|string',
        ];
    }

    public function setOrderModel(Order $orderModel): void
    {
        $this->orderModel = $orderModel;
        
        $this->unit = $this->orderModel->unit;
        $this->description = $this->orderModel->description;
        $this->req_qty = $this->orderModel->req_qty;
        $this->rem_qty = $this->orderModel->rem_qty;
        $this->sch_qty = $this->orderModel->sch_qty;
        $this->uom = $this->orderModel->uom;
        $this->required_date = $this->orderModel->required_date;
        $this->pick_up_from = $this->orderModel->pick_up_from;
        $this->destination = $this->orderModel->destination;
        $this->wr_number = $this->orderModel->wr_number;
        $this->rig_name = $this->orderModel->rig_name;
        $this->pic = $this->orderModel->pic;
        $this->change = $this->orderModel->change;
        $this->post_id = $this->orderModel->post_id;
    }

    public function store(): void
    {
        $this->orderModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderModel->update($this->validate());

        $this->reset();
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
class Items extends Component
{
    public $orderItems = [];
    public $allItems = [];

    public function mount()
    {
        $this->allItems = Item::all();
        $this->orderItems = [
            ['item_id' => '', 'quantity' => 1, 'sales_price' => '']
        ];
    }

    public function addItem()
    {
        $this->orderItems[] = ['item_id' => '', 'quantity' => 1, 'sales_price' => ''];
    }

    public function removeItem($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems);
    }

    public function render()
    {
        info($this->orderItems);
        return view('livewire.items');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $cart = ['items' => [],'total'=>0];

    public $seniorDiscount = 0, $manualDiscount = 0, $grandTotal;

    public function mount(){
        if(session('cart')) $this->cart = session('cart');
    }

    private function calculateGrandTotal(){
        $this->grandTotal = $this->cart['total']-$this->seniorDiscount-$this->manualDiscount;
    }

    public function render()
    {
        $this->calculateGrandTotal();
        return view('livewire.checkout');
    }
}

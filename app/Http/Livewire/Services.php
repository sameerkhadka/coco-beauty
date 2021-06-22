<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Service;
use Livewire\Component;



class Services extends Component
{
    public $services, $items;

    public function render()
    {
        $this->services = Service::orderBy('order')->get();
        $this->items = Item::orderBy('created_at','desc')->get();
        return view('livewire.services');
    }
}

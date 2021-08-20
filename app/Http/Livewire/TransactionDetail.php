<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class TransactionDetail extends Component
{
    public $transaction;
    public function mount(){
        if(request('id')){
            $this->transaction = Transaction::find(request('id'));
        }
        else{
            abort('404');
        }
    }
    public function render()
    {
        return view('livewire.transaction-detail');
    }
}

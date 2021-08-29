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
        $opiGelAndNormal = json_decode($this->transaction->opi_gel_and_normal,true);
        $bandiColourGel = json_decode($this->transaction->bandi_colour_gel,true);
        $cart = json_decode($this->transaction->cart);
        return view('livewire.transaction-detail',compact('opiGelAndNormal','bandiColourGel','cart'));
    }
}

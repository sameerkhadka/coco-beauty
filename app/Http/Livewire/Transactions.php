<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Transactions extends Component
{
    public $transactions,$sortDate,$cash,$card,$total;

    public function mount(){
        $this->sortDate = [
            'date' => null,
            'type' => 'all'
        ];
        $this->cash = Transaction::where('payment_method','cash')->sum('cart->grand_total');
        $this->card = Transaction::where('payment_method','card')->sum('cart->grand_total'); 
        $this->total = $this->cash + $this->card;
    }
    public function updateSorting($type){
        switch($type){
            case 'today':
                $this->sortDate=[
                    'date' => Carbon::today()->toDateString(),
                    'type' => $type
                ];
                $this->cash = Transaction::whereDate('created_at','=',$this->sortDate['date'])->where('payment_method','cash')->sum('cart->grand_total');
                $this->card = Transaction::whereDate('created_at','=',$this->sortDate['date'])->where('payment_method','card')->sum('cart->grand_total'); 
                $this->total = $this->cash + $this->card;
                break;
            case 'tomorrow':
                $this->sortDate=[
                    'date' => Carbon::today()->addDays(1)->toDateString(),
                    'type' => $type
                ];
                break;
            case 'nextWeek':
                $this->sortDate=[
                    'date' => Carbon::today()->addDays(7)->toDateString(),
                    'type' => $type
                ];
                break;
            default:
                $this->sortDate = [
                    'date' => null,
                    'type' => 'all'
                ];
                $this->cash = Transaction::where('payment_method','cash')->sum('cart->grand_total');
                $this->card = Transaction::where('payment_method','card')->sum('cart->grand_total'); 
                $this->total = $this->cash + $this->card; 
                break;
        }

    }
    public function render()
    {
        $sortDate = $this->sortDate;
        $this->transactions = Transaction::orderBy('created_at','desc')->when($sortDate['date'], function($query) use ($sortDate) {
            return $query->whereDate('created_at','=',$sortDate['date']);
        })->get();
        return view('livewire.transactions');
    }
}

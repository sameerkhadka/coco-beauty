<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Transactions extends Component
{
    public $transactions,$sortDate,$cash,$card,$total,$gift,$from,$to;

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

    public function filter()
    {
       
    }

    public function render()
    {
        $sortDate = $this->sortDate;
        $from = $this->from;
        $to = $this->to;
        $transactions = Transaction::orderBy('created_at','desc')->when($sortDate['date'], function($query) use ($sortDate) {
            return $query->whereDate('created_at','=',$sortDate['date']);
        })->when($from, function($query) use ($from) {
            return $query->whereDate('created_at','>=',$from);
        })->when($to, function($query) use ($to) {
            return $query->whereDate('created_at','<=',$to);
        })->get();
        $this->transactions = $transactions;
        $this->gift = $transactions->where('type','voucher')->sum('cart.grand_total');
        $this->cash = $transactions->where('payment_method','cash')->sum('cart.grand_total');
        $this->card = $transactions->where('payment_method','card')->sum('cart.grand_total'); 
        $this->total = $this->cash + $this->card; 
        return view('livewire.transactions');
    }
}

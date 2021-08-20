<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Transactions extends Component
{
    public $transactions,$sortDate;

    public function mount(){
        $this->sortDate = [
            'date' => null,
            'type' => 'all'
        ];
    }
    public function updateSorting($type){
        switch($type){
            case 'today':
                $this->sortDate=[
                    'date' => Carbon::today()->toDateString(),
                    'type' => $type
                ];
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

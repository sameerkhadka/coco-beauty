<?php

namespace App\Http\Livewire;

use App\Models\BirthdayDiscountUsage;
use App\Models\Member;
use Carbon\Carbon;
use Livewire\Component;

class Birthdays extends Component
{
    public $members,$sortDate = [
        'type' => 'thisMonth',
        'month' => ''
    ];
    public function mount(){
        $this->sortDate['month'] = Carbon::today()->month;
        $this->generateData();
    }

    // go to checkout page
    public function gotoCheckOutPage(){
        if(session('cart')){
            $cart = session('cart');
            if(count($cart['items'])>0){
                return $this->redirect('/checkout');
            }

        }
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'info','message'=>'Cart is empty.']);
    }

    private function generateData(){
        $thisYear = Carbon::now()->year;
        $this->members = Member::orderBy('created_at','desc')->whereMonth('dob',$this->sortDate['month'])->get()->map(function($item) use ($thisYear){
            if(BirthdayDiscountUsage::where('member_id',$item->id)->whereYear('used_date',$thisYear)->first()){
                $item['used'] = true;
            }
            else{
                $item['used'] = false;
            }
            return $item;
        });
    }
    public function updateSorting($type){
        switch($type){
            case 'thisMonth':
                $this->sortDate=[
                    'month' => Carbon::today()->month,
                    'type' => $type
                ];
                break;
            case 'lastMonth':
                $this->sortDate=[
                    'month' => Carbon::today()->subMonth(1)->month,
                    'type' => $type
                ];
                break;
            case 'nextMonth':
                $this->sortDate=[
                    'month' => Carbon::today()->addMonth(1)->month,
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
        $this->generateData();

    }
    public function render()
    {
        return view('livewire.birthdays');
    }
}

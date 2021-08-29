<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Transaction;
use Livewire\Component;

class MemberDetail extends Component
{
    public $member,$transactions;
    public function mount(){
        if(request('id')){
            $this->member = Member::find(request('id'));
            $this->transactions = Transaction::where('member_id',request('id'))->orderBy('created_at','desc')->get();
        }
        else{
            abort('404');
        }
    }
    public function render()
    {
        return view('livewire.member-detail');
    }
}

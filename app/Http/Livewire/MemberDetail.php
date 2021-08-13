<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberDetail extends Component
{
    public $member;
    public function mount(){
        if(request('id')){
            $this->member = Member::find(request('id'));
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

<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Transaction;
use Livewire\Component;

class MemberDetail extends Component
{
    public $member,$transactions,$notifications;
    public function mount(){
        if(request('id')){
            $this->member = Member::find(request('id'));
            $this->transactions = Transaction::where('member_id',request('id'))->orderBy('created_at','desc')->get();
        }
        else{
            abort('404');
        }
    }
    public function updateRemarks($id,$remark){
        $transaction = Transaction::find($id);
        $transaction->remarks = $remark;
        $transaction->update();
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Successfully Updated']);

    }
    public function updateStatus($id,$status){
        $transaction = Transaction::find($id);
        $transaction->status = $status ? 0 : 1;
        $transaction->update();
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Successfully Updated']);
    }
    public function render()
    {
        return view('livewire.member-detail');
    }
}

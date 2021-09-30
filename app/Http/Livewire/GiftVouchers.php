<?php

namespace App\Http\Livewire;

use App\Models\GiftVoucher;
use App\Models\Member;
use App\Models\Transaction;
use Livewire\Component;

class GiftVouchers extends Component
{
    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];

    //extra
    public $members,$isMember="0";

    //commons
    public $items,$checkbox,$menuOpen=false, $submitButton = false, $checkedItems=[], $checkAll=false, $paymentMethod = 'cash';

    //model data
    public $modelData = [
        'gift_for'=>'',
        'name'=>'',
        'discount'=>'',
        'email'=>'',
        'phone'=>'',
        'issue_date'=>'',
    ];

    public function updatedIsMember(){
        $this->modelData['gift_for']="0";
        $this->modelData['name'] = "";
        $this->modelData['email'] = "";
        $this->modelData['phone'] = "";
    }

    // goto checkout page
    public function gotoCheckOutPage(){
        if(session('cart')){
            $cart = session('cart');
            if(count($cart['items'])>0){
                return $this->redirect('/checkout');
            }

        }
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'info','message'=>'Cart is empty.']);
    }
    //deleting
    public function deleteSelected(){
        foreach (GiftVoucher::whereIn('id',$this->checkedItems)->get() as $item){
            if($item->transaction_id)
             Transaction::find($item->transaction_id)->delete();
        }
        GiftVoucher::destroy($this->checkedItems);

        // if appointmentID has been
        if(isset($this->modelData['id'])){
            if(in_array($this->modelData['id'],$this->checkedItems)){
                $this->emptyData();
                $this->menuOpen = false;
            }
        }
        // reverting array to empty
        $this->checkedItems = [];
        $this->checkedItems = false;
        $this->checkAll = false;
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Successfully Deleted']);
    }

    public function confirmBox($id=null){
        // if id is null then, it is deleteAll
        if($id){
            $this->checkAll = false;
            $this->checkedItems = [];
            $this->checkedItems[] = (string)$id;
            $this->dispatchBrowserEvent('from-backend',['is'=>'alert']);
        }
        else{
            $this->dispatchBrowserEvent('from-backend',['is'=>'alert']);
        }
    }

    //add data
    public function addData(){
        $this->emptyData();
        $this->menuOpen = true;
        $this->modelData['gift_for'] = "0";

    }

    //edit data
    public function editData($id){
        $this->emptyData();
        $appointment = GiftVoucher::find($id)->toArray();
        $this->modelData = $appointment;
        $this->menuOpen = true;
    }


    public function pluckedMembers(){
        return array_map(function($el) {
            return  (string)$el;
        }, $this->items->pluck('id')->toArray());
    }

    public function updatedCheckAll(){
        if($this->checkAll){
            $this->checkedItems = $this->pluckedMembers();
        }
        else{
            $this->checkedItems = [];
        }
    }

    public function updatedCheckedItems(){
        if(array_sum($this->checkedItems) == array_sum($this->items->pluck('id')->toArray())){
            $this->checkAll = true;
        }
        else{
            $this->checkAll = false;
        }
    }

    //cancel can be used in both add and update as it only empty items data;
    public function cancelEdit(){
        $this->menuOpen = false;
        $this->emptyData();
    }

    public function submit(){
        if(isset($this->modelData['id'])){
            if(!$this->modelData['issue_date']) $this->modelData['issue_date'] = null;
            if(!$this->modelData['gift_for']) $this->modelData['gift_for'] = null;
            GiftVoucher::find($this->modelData['id'])->update($this->modelData);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'GiftVoucher Updated Successfully']);
        }
        else{
            if(!$this->modelData['issue_date']) $this->modelData['issue_date'] = null;
            if(!$this->modelData['gift_for']) $this->modelData['gift_for'] = null;
            $giftVoucher = GiftVoucher::create($this->modelData);
            // create transaction of that gift voucher
            $modelTransaction = [];
            $modelTransaction['type'] = 'voucher';
            $modelTransaction['cart'] = json_encode([
                'grand_total'=>$giftVoucher->discount
            ]);
            $modelTransaction['payment_method'] = $this->paymentMethod;
            if($giftVoucher->gift_for){
                $modelTransaction['member_id'] = $giftVoucher->gift_for;
                $member = Member::find($giftVoucher->gift_for);
                $modelTransaction['full_name'] = $member->first_name.' '.$member->last_name;
                $modelTransaction['email'] = $member->email;
                $modelTransaction['phone'] = $member->phone;
            }else{
                $modelTransaction['full_name']=$giftVoucher->name;
                $modelTransaction['email'] =$giftVoucher->email;
                $modelTransaction['phone'] =$giftVoucher->phone;
            }
            $transaction = Transaction::create($modelTransaction);
            // set giftVoucher transaction id
            $giftVoucher->transaction_id = $transaction->id;
            $giftVoucher->update();

            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'GiftVoucher Added Successfully']);
        }
        $this->emptyData();
        $this->menuOpen = false;
    }

    private function emptyData(){
        $this->checkAll=false;
        $this->checkedItems = [];
        $this->isMember = "0";
        $this->modelData = [
            'gift_for'=>'',
            'name'=>'',
            'discount'=>'',
            'email'=>'',
            'phone'=>'',
            'issue_date'=>'',
        ];

    }

    public function mount()
    {
        $this->members = Member::all();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('select2');
        if($this->modelData['gift_for']) $this->isMember = "1";

        $this->items = GiftVoucher::orderBy('created_at','desc')->get();
        return view('livewire.gift-vouchers');
    }
}

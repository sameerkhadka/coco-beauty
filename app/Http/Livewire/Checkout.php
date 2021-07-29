<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Promotion;
use Livewire\Component;

class Checkout extends Component
{
    //resources
    public $members,$promotions;

    public $cart = ['items' => [],'total'=>0];

    public $manualDiscount = "0";
    public $promotionID = "0", $memberID="0" , $isMember = "0", $userDetails = ['fullName'=>'','phone'=>'','email'=>'','address'=>''];

    public $transactions = [
      "is_member" => "0",
        "member_id" => "0",
      "full_name" => "",
      "phone" => "",
      "email" => "",
      "address" => "",
        "grandTotal" => "",
        "cart" => "",
        "promotion" => [
            "name" => "",
            "discount" => "",
            "discount_amount" => "0"
        ],
        "manual_discount" => "0",
        "gift_card" => [
            "voucher_number" => "",
            "amount" => "",
        ],
        "note" => "",
        "payment_method" => ""
    ];


    public function updatedManualDiscount(){
        $this->transactions['manual_discount'] = $this->manualDiscount ? $this->manualDiscount : "0";
    }
    public function updatedPromotionID(){
        if($this->promotionID){
            $promotion = Promotion::find($this->promotionID);
            $this->transactions['promotion']['name'] = $promotion['name'];
            $this->transactions['promotion']['discount'] = $promotion['discount'];
            $this->transactions['promotion']['discount_amount'] = ($promotion['discount'] / 100) * $this->cart['total'];
        }
        else{
            // default setting
            $this->transactions['promotion'] = [
                "name" => "",
                "discount" => "",
                "discount_amount" => "0"
            ];
        }
    }
    public function mount(){
        $this->members = Member::all();
        $this->promotions = Promotion::all();
        if(session('cart')) $this->cart = session('cart');
    }

    public function updatedIsMember(){
        $this->clearUserDetails();
        $this->memberID = "0";
    }

    public function updatedMemberID(){
        $this->clearUserDetails();
        $member =  Member::find($this->memberID);
        $this->userDetails['fullName'] = $member->first_name.' '.$member->last_name;
        $this->userDetails['phone'] = $member->phone;
        $this->userDetails['email'] = $member->email;
        $this->userDetails['address'] = $member->address;
    }

    private function calculateGrandTotal(){
        $this->transactions['grand_total'] = $this->cart['total']-$this->transactions['promotion']['discount_amount']-$this->transactions['manual_discount'];
    }

    private function clearUserDetails(){
        $this->userDetails = ['fullName'=>'','phone'=>'','email'=>'','address'=>''];
    }

    public function render()
    {
        $this->dispatchBrowserEvent('memberSelect');
        $this->dispatchBrowserEvent('promotionSelect');
        $this->calculateGrandTotal();
        return view('livewire.checkout');
    }
}

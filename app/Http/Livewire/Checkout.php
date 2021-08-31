<?php

namespace App\Http\Livewire;

use App\Models\BandiColourGel;
use App\Models\BirthdayDiscountUsage;
use App\Models\GiftVoucher;
use App\Models\Member;
use App\Models\OpiGelAndNormal;
use App\Models\Promotion;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Checkout extends Component
{
    //resources
    public $members,$promotions,$giftVouchers, $bandiColourGels,$opiGelAndNormals;

    public $cart = ['items' => [],'total'=>0];

    public $manualDiscount = "0";
    public $showBirthdayAlert = "0",$isBirthdayDiscount = false,$birthdayDiscountAlreadyUsed = false;
    public $modelBandiColourGel = [],$modelOpiGelAndNormal=[],$description="",$remarks="",$paymentMethod="",$promotionID = "0",$giftVoucherID="0", $memberID="0" , $isMember = "0", $userDetails_fullName,$userDetails_phone,$userDetails_email,$userDetails_address;
    protected $rules = [
        'userDetails_fullName' => 'required',
    ];
    protected $messages = [
        'userDetails_fullName.required' => 'The Full Name cannot be empty.',
    ];
    public $transactions = [
        "member_id" => "0",
      "full_name" => "",
      "phone" => "",
      "email" => "",
      "address" => "",
        "promotion_id" => "0",
        "promotion" => [
            "name" => "",
            "discount" => "",
            "discount_amount" => "0"
        ],
        "gift_voucher_id"=>"0",
        "gift_voucher" => [
            "voucher_number" => "",
            "discount" => "",
            "discount_amount" => "0"
        ],
        "manual_discount" => "0",
        "description" => "",
        "remarks" => "",
        "grand_total"=>"0",
        "birthday_discount_amount" => "0",
        "is_birthday_discount" => "",
        "payment_method" => "",
        "bandi_colour_gel" => [],
        "opi_gel_and_normal" => [],
    ];


    public function rerender(){

    }
    public function updatedModelBandiColourGel(){
        $this->transactions['bandi_colour_gel'] = $this->modelBandiColourGel;
    }

    public function updatedModelOpiGelAndNormal(){
        $this->transactions['opi_gel_and_normal'] = $this->modelOpiGelAndNormal;
    }

    public function updatedPaymentMethod(){
        $this->transactions['payment_method'] = $this->paymentMethod;
        session(['transactions'=>$this->transactions]);
    }

    public function updatedIsBirthdayDiscount(){
        $this->transactions['is_birthday_discount'] = $this->isBirthdayDiscount;
        if($this->isBirthdayDiscount) $this->transactions['birthday_discount_amount'] = (10/100)*$this->cart['total'];
        else $this->transactions['birthday_discount_amount'] = "0";
        session(['transactions'=>$this->transactions]);
    }

    public function updatedDescription(){
        $this->transactions['description'] = $this->description;
        session(['transactions'=>$this->transactions]);
    }

    public function updatedRemarks(){
        $this->transactions['remarks'] = $this->remarks;
        session(['transactions'=>$this->transactions]);
    }

    public function updatedManualDiscount(){
        $this->manualDiscount = $this->manualDiscount=="" ? "0" : $this->manualDiscount;
        $this->transactions['manual_discount'] = $this->manualDiscount ? $this->manualDiscount : "0";
        session(['transactions'=>$this->transactions]);
    }
    public function updatedMemberID(){
        $this->clearUserDetails();
        $member =  Member::find($this->memberID);
        $this->userDetails_fullName = $member->first_name.' '.$member->last_name;
        $this->userDetails_phone = $member->phone;
        $this->userDetails_email = $member->email;
        $this->userDetails_address = $member->address;
        $this->updateTransactionObject();
        if($member->dob){
            $thisYear = Carbon::now()->year;
            if(BirthdayDiscountUsage::where('member_id',$this->memberID)->whereYear('used_date',$thisYear)->first()){
                $this->showBirthdayAlert = "0";
                $this->birthdayDiscountAlreadyUsed = true;
            }
            else{
                if(Carbon::create($member->dob)->month==Carbon::now()->month){
                    $this->showBirthdayAlert = "1";
                }
                else{
                    $this->showBirthdayAlert = "0";
                }
            }
        }
        else{
            $this->showBirthdayAlert = "0";
        }
    }
    public function updatedGiftVoucherID(){
        if($this->giftVoucherID){
            $giftVoucher = GiftVoucher::find($this->giftVoucherID);
            $this->transactions['gift_voucher_id'] = $this->giftVoucherID;
            $this->transactions['gift_voucher']['name'] = $giftVoucher['name'];
            $this->transactions['gift_voucher']['discount'] = $giftVoucher['discount'];
            $this->transactions['gift_voucher']['discount_amount'] = ($giftVoucher['discount'] / 100) * $this->cart['total'];
            session(['transactions'=>$this->transactions]);

        }
        else{
            // default setting
            $this->transactions['gift_voucher_id'] = "0";
            $this->transactions['gift_voucher'] = [
                "name" => "",
                "discount" => "",
                "discount_amount" => "0"
            ];
            session(['transactions'=>$this->transactions]);

        }
    }

    public function updatedPromotionID(){
        if($this->promotionID){
            $promotion = Promotion::find($this->promotionID);
            $this->transactions['promotion_id'] = $this->promotionID;
            $this->transactions['promotion']['name'] = $promotion['name'];
            $this->transactions['promotion']['discount'] = $promotion['discount'];
            $this->transactions['promotion']['discount_amount'] = ($promotion['discount'] / 100) * $this->cart['total'];
            session(['transactions'=>$this->transactions]);

        }
        else{
            // default setting
            $this->transactions['promotion_id'] = "0";
            $this->transactions['promotion'] = [
                "name" => "",
                "discount" => "",
                "discount_amount" => "0"
            ];
            session(['transactions'=>$this->transactions]);

        }
    }

    public function mount(){
        $this->members = Member::all();
        $this->promotions = Promotion::get();
        $this->giftVouchers = GiftVoucher::where('used_date',null)->get();
        $this->bandiColourGels = BandiColourGel::all();
        $this->opiGelAndNormals = OpiGelAndNormal::all();
        if(session('cart')) $this->cart = session('cart');
        if(session('transactions')){
            $this->transactions = session('transactions');
            if($this->transactions['member_id']){
                $this->isMember = "1";
                $this->memberID = $this->transactions['member_id'];
                $this->updatedMemberID();
            }
            if($this->transactions['gift_voucher']){
                $this->giftVoucherID = $this->transactions['gift_voucher_id'];
                $this->updatedGiftVoucherID();
            }
            if($this->transactions['promotion_id']){
                $this->promotionID = $this->transactions['promotion_id'];
                $this->updatedPromotionID();
            }
            if($this->transactions['manual_discount']){
                $this->manualDiscount = $this->transactions['manual_discount'];
                $this->updatedManualDiscount();
            }

            if($this->transactions['description']){
                $this->description = $this->transactions['description'];
            }

            if($this->transactions['payment_method']){
                $this->paymentMethod = $this->transactions['payment_method'];
            }

            // set opi gel and bandi to emtpy array
            $this->transactions['opi_gel_and_normal'] = [];
            $this->transactions['bandi_colour_gel'] = [];
        }

        /** if there is any session of member id then $this->memberID = session('memberID')
         * and call updatedMemberID();
         */
    }

    public function updatedIsMember(){
        $this->clearUserDetails();
        $this->memberID = "0";
        $this->updateTransactionObject();
    }



    private function updateTransactionObject(){
        $this->transactions['member_id'] = $this->memberID;
        $this->transactions['full_name'] = $this->userDetails_fullName ;
        $this->transactions['phone'] =$this->userDetails_phone;
        $this->transactions['email'] =$this->userDetails_email;
        $this->transactions['address'] = $this->userDetails_address;
        session(['transactions'=>$this->transactions]);
    }

    private function calculateGrandTotal(){
        $this->transactions['grand_total'] = $this->cart['total']-$this->transactions['gift_voucher']['discount_amount']-$this->transactions['promotion']['discount_amount']-($this->manualDiscount/100)*$this->cart['total'] - $this->transactions['birthday_discount_amount']  ;
    }

    private function clearUserDetails(){
        $this->userDetails_fullName = "";
        $this->userDetails_phone = "";
        $this->userDetails_email = "";
        $this->userDetails_address = "";
        $this->showBirthdayAlert = "0";
        $this->transactions['is_birthday_discount'] = false;
        $this->isBirthdayDiscount = false;
        $this->transactions['birthday_discount_amount'] = "0";
        $this->birthdayDiscountAlreadyUsed = false;
        $this->updateTransactionObject();
    }


    public function proceedTransaction(){
        $this->validate();
        /** save transaction table */
        $transactions = $this->transactions;
        if(!$transactions['member_id']){
            $transactions['member_id'] = null;
            $transactions['full_name']=$this->userDetails_fullName;
            $transactions['phone']=$this->userDetails_phone;
            $transactions['email']=$this->userDetails_email;
            $transactions['address']=$this->userDetails_address;
        }
        $cart = $this->cart;
        foreach (['gift_voucher','promotion'] as $gOrP){
            if($transactions["{$gOrP}_id"]) {
                $transactions[$gOrP]['id'] = (int)$transactions["{$gOrP}_id"];
                $transactions[$gOrP] = json_encode($transactions[$gOrP]);
            }
            else
                $transactions[$gOrP] = null;
            unset($transactions["{$gOrP}_id"]);
        }
        $transactions['bandi_colour_gel'] = json_encode($transactions['bandi_colour_gel']);
        $transactions['opi_gel_and_normal'] = json_encode($transactions['opi_gel_and_normal']);
        $cart['grand_total'] = $transactions['grand_total'];
        $cart['birthday_discount_amount'] = $transactions['birthday_discount_amount'];
        $cart['is_birthday_discount'] = $transactions['is_birthday_discount'];
        unset($transactions['grand_total'],$transactions['birthday_discount_amount'],$transactions['is_birthday_discount']);
        $transactions['cart'] = json_encode($cart);
        Transaction::create($transactions);

        /** if the user is member i.e, member_id!=null then go further */
        if($transactions['member_id']) {
            /** if is_birthday_discount is true then do entry in birthday_discount_usages table of that member */
            if($this->transactions['is_birthday_discount']){
                BirthdayDiscountUsage::create([
                    'member_id'=>$transactions['member_id'],
                    'used_date'=>now()
                ]);
            }
        }
        /** same goes to voucher and promotion discount, set that voucher card to used (maybe) */
        if($this->transactions['promotion_id'])
            Promotion::find($this->transactions['promotion_id'])->update([
                'used_date'=>now()
            ]);
        if($this->transactions['gift_voucher_id'])
            GiftVoucher::find($this->transactions['gift_voucher_id'])->update([
                'used_date'=>now()
            ]);
        /** clear all session data */
        Session::flush();
        /** direct to home page now */
        return redirect(route('services'));


    }

    public function render()
    {
        $this->dispatchBrowserEvent('memberSelect');
        $this->dispatchBrowserEvent('opiGelAndNormal');
        $this->dispatchBrowserEvent('bandiColourGelSelect');
        $this->dispatchBrowserEvent('giftVoucherSelect');
        $this->dispatchBrowserEvent('promotionSelect');
        $this->calculateGrandTotal();
        return view('livewire.checkout');
    }
}

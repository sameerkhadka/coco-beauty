<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Member;
use App\Models\Service;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;



class Services extends Component
{
    public $services, $items;

    public $cart = ['items' => [],'total'=>0];
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

    private function calculateTotal(){
        if(count($this->cart['items'])>0) $cartItems = collect($this->cart['items']);
        else $this->cart['total']=0;

        if(isset($cartItems))
            $this->cart['total'] = $cartItems->sum(function($cartItem){
                return $cartItem['item']['price'] && $cartItem['quantity'] ? $cartItem['item']['price']*$cartItem['quantity'] : 0;
            });
    }

    public function addToCart($id){
        $toBeAddedItem = Item::find($id);
        //check whether item is already contain or not
        if(count(collect($this->cart['items'])->where('item.id',$id))>0){
            $this->cart['items'] =  collect($this->cart['items'])->map(function($collection, $key) use ($id){
                if($collection['item']['id']==$id){
                    return ['item'=>$collection['item'],'quantity'=>$collection['quantity']+1];
                }
                else{
                    return $collection;
                }
            })->values();
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Quantity is increased as it is already in cart']);
        }
        else{
            $toBePushed = ['item' => $toBeAddedItem, 'quantity'=>1];
            array_push($this->cart['items'],$toBePushed);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>$toBeAddedItem->name.' added to cart.']);
        }
    }

    public function removeItem($id){
        try{
            $id = Crypt::decrypt($id);
            $this->cart['items'] = collect($this->cart['items'])->filter(function($cartItem) use ($id){
                return $cartItem['item']['id']!=$id;
            })->values();
        }catch(DecryptException $e){
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'error','message'=>'Unexpected Error']);
        }

    }

    public function emptyCart(){
        $this->cart = ['items' => [],'total'=>0];
    }

    public function mount(){
        // if transaction is already there in session then, initialize that session here (not empty) by default transactions is empty
        if(session('transactions')){
            $this->transactions = session('transactions');
        }
        if(request('key')){
            $memberID = decrypt(request('key'));
            $this->transactions['member_id']  = $memberID;
            $this->transactions['full_name']  = Member::find($memberID)->full_name;
        }
        session(['transactions'=>$this->transactions]);

        // set cart from session if session contain cart
        if(session('cart')) $this->cart = session('cart');
    }

    public function render()
    {
        // set cart of session to livewire cart
        $this->calculateTotal();
        session(['cart'=>$this->cart]);
        $this->services = Service::orderBy('order')->get();
        $this->items = Item::orderBy('created_at','desc')->get();
        $memberName = isset(session('transactions')['member_id']) ? session('transactions')['full_name'] : 0;
        return view('livewire.services',compact('memberName'));
    }
}

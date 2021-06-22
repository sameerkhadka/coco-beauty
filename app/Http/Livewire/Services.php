<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Service;
use Livewire\Component;



class Services extends Component
{
    public $services, $items;

    public $cart = ['items' => [],'total'=>0];

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
        $this->cart['items'] = collect($this->cart['items'])->filter(function($cartItem) use ($id){
           return $cartItem['item']['id']!=$id;
        })->values();
    }

    public function emptyCart(){
        $this->cart = ['items' => [],'total'=>0];
    }

    public function mount(){
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
        return view('livewire.services');
    }
}

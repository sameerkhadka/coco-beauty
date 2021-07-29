<div class="main">
    @if(count($this->cart['items'])>0)
    <div class="main-content">

        <div class="checkout-box">
            <div class="transaction-box">
                <div class="tb-info">
                    <h4 class="transaction-tb-head">Personal Information</h4>

                    <div class="choose-mem">
                        <label class="cm-card">
                            Non Member
                            <input type="radio" checked="checked" value="0"  wire:model="isMember">
                            <span class="checkmark"></span>
                        </label>
                        <label class="cm-card">
                            Member
                            <input type="radio" value="1" wire:model="isMember">
                            <span class="checkmark"></span>
                        </label>
                        @if($isMember)
                            <div class="d-inline-block" style="min-width: 396px;">
                                <select id="searchable" style="width: 100%" wire:model.debounce.500ms="memberID">
                                    <option value="0" disabled>Select Name</option>
                                    @foreach ($members as $item)
                                        <option value="{{ $item->id }}">CBL{{ "{$item->id} - {$item->first_name} {$item->last_name}, {$item->phone}" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>

                    <div class="cart-entries">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Full Name</label>
                                    <input type="text" wire:model.defer="userDetails.fullName" {{ $isMember ? 'disabled' : '' }}>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Phone</label>
                                    <input type="number" wire:model.defer="userDetails.phone" {{ $isMember ? 'disabled' : '' }}>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Email</label>
                                    <input type="email" wire:model.defer="userDetails.email" {{ $isMember ? 'disabled' : '' }}>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Address</label>
                                    <input type="text" wire:model.defer="userDetails.address" {{ $isMember ? 'disabled' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tb-info">
                    <h4 class="transaction-tb-head">Promotion & Discounts</h4>

                    <div class="cart-entries">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="entry">
                                    <label >Promotion</label>
                                    <select id="promotion_searchable" style="width: 100%" wire:model.debounce.500ms="promotionID">
                                        <option value="0">--None--</option>
                                        @foreach ($promotions as $item)
                                            <option value="{{ $item->id }}">CBLP{{ "{$item->id} - {$item->name}, {$item->discount}% Discount" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="entry">
                                    <label >Discount Amount</label>
                                    <input wire:model.debounce.500ms = "manualDiscount" type="number">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="entry">
                                    <label >Gift Card</label>
                                    <input type="number">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tb-info">
                    <h4 class="transaction-tb-head">Note</h4>

                    <div class="cart-entries">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Description</label>
                                    <textarea></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="tb-info payment-method">
                    <h4 class="transaction-tb-head">Payment Method</h4>

                    <div class="choose-mem">
                        <label class="cm-card">
                            Cash
                            <input type="radio" checked="checked" name="payment-method">
                            <span class="checkmark"></span>
                        </label>

                        <label class="cm-card">
                            Card
                            <input type="radio"  name="payment-method">
                            <span class="checkmark"></span>
                        </label>

                    </div>

                </div>


            </div>

            <div class="cart-wrap">
                <div class="checkout-head">
                    <h4>Service Cart</h4>
                    <p>You have {{count($cart['items'])}} items in your cart </p>
                </div>
                @foreach($cart['items'] as $cartItem)
                <div class="cart-sing">
                    <div class="cart-ser-des">
                        <h5>{{$cartItem['item']['name']}}</h5>
                        <p>{{$cartItem['item']['type']}}</p>
                    </div>

                    <div class="cart-qty">
                        <input type="number" class="qty-value" value="{{$cartItem['quantity']}}" readonly />
                    </div>

                    <div class="cart-price-total">
                        <h6>${{$cartItem['item']['price']}}</h6>
                    </div>

                </div>
                @endforeach



                <div class='cart-amount'>
                    <div class="cart-total">
                        <h4 class="cart-total-price">${{$cart['total']}}</h4>
                    </div>
                    @if($promotionID)
                    <div class="discount">
                        <h6>{{$transactions['promotion']['name']}} Discount</h6>
                        <h5>${{$transactions['promotion']['discount_amount']}}</h5>
                    </div>
                    @endif
                    @if($manualDiscount)
                    <div class="discount">
                        <h6>Manual Discount</h6>
                        <h5>${{$transactions['manual_discount']}}</h5>
                    </div>
                    @endif
                    <div class="cart-grand-total">
                        <h6>Grand Total</h6>
                        <h4 class="cart-total-price">${{$transactions['grand_total']}}</h4>
                    </div>
                </div>

                <div class="checkout">
                    <a href="#" class="aside-btn">Proceed Transaction</a>
                </div>



            </div>

        </div>



    </div>
    @endif
</div>

@push('scripts')
    <script>
        $('#searchable').select2();
        $('#searchable').change(function(){
            var data = $('#searchable').select2("val");
        @this.set('memberID',data);
        });
        window.addEventListener('memberSelect', function(e) {
            $('#searchable').select2();
            $('#searchable').change(function(){
                var data = $('#searchable').select2("val");
                @this.set('memberID',data);
            });
        })

        $('#promotion_searchable').select2();
        $('#promotion_searchable').change(function(){
            var data = $('#promotion_searchable').select2("val");
        @this.set('promotionID',data);
        });
        window.addEventListener('promotionSelect', function(e) {
            $('#promotion_searchable').select2();
            $('#promotion_searchable').change(function(){
                var data = $('#promotion_searchable').select2("val");
            @this.set('promotionID',data);
            });
        })
    </script>
@endpush

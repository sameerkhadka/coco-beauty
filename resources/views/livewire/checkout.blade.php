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
                    @if($isMember)
                        @if($memberID)
                            @if($showBirthdayAlert)
                            <div class="alert alert-success" role="alert">
                                This is your birth Month! Do you want to use your gift card?
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"  wire:model="isBirthdayDiscount">
                                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                </div>
                            </div>
                            @endif
                            @if($birthdayDiscountAlreadyUsed)
                            <div class="alert alert-info" role="alert">
                                You have already used your birthday gift card! Happy Birthday!!
                            </div>
                            @endif
                        @endif
                    @endif
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
                                    <label >Discount Amount (%)</label>
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
                                    <textarea wire:model='description'></textarea>
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
                            <input type="radio" wire:model='paymentMethod' value="cash" name="payment-method">
                            <span class="checkmark"></span>
                        </label>

                        <label class="cm-card">
                            Card
                            <input type="radio" wire:model='paymentMethod' value="card"  name="payment-method">
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
                        <h6>Manual Discount{{ "({$transactions['manual_discount']}%)" }}</h6>
                        <h5>${{($transactions['manual_discount']/100) * $cart['total']}}</h5>
                    </div>
                    @endif
                    @if($isBirthdayDiscount)
                    <div class="discount">
                        <h6>Birthday Discount{{ "(10%)" }}</h6>
                        <h5>${{$transactions['birthday_discount_amount']}}</h5>
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
        /** searchable */

        $('#searchable').select2();

        @if($this->memberID)
        $('#searchable').select2().select2('val','{{ $this->memberID }}')
        @endif

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

        /** promotion */
        $('#promotion_searchable').select2();

        @if($this->promotionID)
        $('#promotion_searchable').select2().select2('val','{{ $this->promotionID }}')
        @endif

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

<div class="main">
    <!-- {{json_encode($transaction)}} -->

    <div class="main-content">
        <div class="trnx-detail">
            <h4><span>Transaction Id:</span> {{'TXN'.$transaction->id}}</h4>
            <h4> <span>Member:</span> {{$transaction->full_name}}</h4>
            <h4><span>Transaction Date:</span> {{date_format($transaction->created_at,'Y/m/d')}}</h4>
        </div>

        <div class="checkout-box">
            <div class="transaction-box">
                <div class="tb-info">
                    <h4 class="transaction-tb-head">Personal Information</h4>

                    <div class="choose-mem">
                        <label class="cm-card">
                            {{$transaction->member_id ? 'Member' : 'Non-Member'}}
                            <input type="radio" checked="checked" >
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="cart-entries">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Full Name</label>
                                    <input type="text" value="{{$transaction->full_name}}" readonly>
                                </div>
                            </div>
                            @if($transaction->phone)
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Phone</label>
                                    <input type="number" value="{{$transaction->phone}}" readonly>
                                </div>
                            </div>
                            @endif
                            @if($transaction->email)
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Email</label>
                                    <input type="email" value="{{$transaction->email}}" readonly>
                                </div>
                            </div>
                            @endif
                            @if($transaction->address)
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Address</label>
                                    <input type="text" value="{{$transaction->address}}" readonly>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="tb-info">
                    <h4 class="transaction-tb-head">Note</h4>

                    <div class="cart-entries">
                        <div class="row">
                            @if($transaction->description)
                            <div class="col-md-6">
                                <div class="entry">
                                    <label>Description</label>
                                    <textarea  readonly>{{$transaction->description}}</textarea>
                                </div>
                            </div>
                            @endif
                            @if($transaction->remarks)
                                <div class="col-md-6">
                                    <div class="entry">
                                        <label>Remarks</label>
                                        <textarea  readonly>{{$transaction->remarks}}</textarea>
                                    </div>
                                </div>
                            @endif
                            @if(count($bandiColourGel)>0)
                            <div class="col-md-12">
                                <div class="entry">
                                    <label >Bandi Color Gel</label>
                                    <input type="text" value="@foreach($bandiColourGel as $id) {{\App\Models\BandiColourGel::find($id)->name}}{{!$loop->last ? ',': ''}} @endforeach" readonly>
                                </div>
                            </div>
                            @endif
                            @if(count($opiGelAndNormal)>0)
                            <div class="col-md-12">
                                <div class="entry">
                                    <label >OPI Gel And Normal</label>
                                    <input type="text" value="@foreach($opiGelAndNormal as $id) {{\App\Models\OpiGelAndNormal::find($id)->name}}{{!$loop->last ? ',': ''}} @endforeach" readonly>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="tb-info payment-method">
                    <h4 class="transaction-tb-head">Payment Method</h4>

                    <div class="choose-mem">
                        <label class="cm-card">
                            {{ucfirst($transaction->payment_method)}}
                            <input type="radio"  checked name="payment-method" readonly>
                            <span class="checkmark"></span>
                        </label>



                    </div>

                </div>

                <div class="tb-info package-deals">
                    <h4 class="transaction-tb-head">Package Deals</h4>

                    <div class="row">
                        <div class="col-md-6 duplicate">  <!-- this div is duplicate on add click -->
                            <div class="cart-entries">
                                <button class="pack-delete">x</button>

                                <div class="entry">
                                    <label >Package Deal </label>
                                    <input type="text">
                                </div>

                                <div class="entry number-small">
                                    <label >Pack Number </label>
                                    <input type="number">
                                </div>


                                <div class="pack-dates">
                                    <div class="entry">
                                        <label >Used Dates </label>
                                    </div>

                                    <div class="pack-date-card">
                                        <input class="form-check-input" type="checkbox" value="" >    
                                        <input type="date" class="date-input">
                                           
                                  
                                    </div>

                                    <div class="pack-date-card">
                                        <input class="form-check-input" type="checkbox" value="" >
                                        <input type="date" class="date-input">
                                      
                                    </div>

                                    <div class="pack-date-card">
                                        <input class="form-check-input" type="checkbox" value="" >
                                        <input type="date" class="date-input">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                

                    

                    <div class="pack-footer">
                            <button class="add">Add</button>
                            <button class="save">Save</button>

                    </div>
                </div>
            </div>

            <div class="cart-wrap">
                <div class="checkout-head">
                    <h4>Service Cart</h4>
                    <p>{{count($cart->items)}} items in this cart </p>
                </div>
                @foreach($cart->items as $item)
                <div class="cart-sing">
                    <div class="cart-ser-des">
                        <h5>{{$item->item->name}}</h5>
                        <p>{{$item->item->type}}</p>
                    </div>

                    <div class="cart-qty">
                        <input type="number" class="qty-value" value="{{$item->quantity}}" readonly="">
                    </div>

                    <div class="cart-price-total">
                        <h6>${{$item->item->price}}</h6>
                    </div>

                </div>
                @endforeach
                <div class="cart-amount">
                    <div class="cart-total">
                        <h4 class="cart-total-price">${{$cart->total}}</h4>
                    </div>
                    @if($transaction->promotion)
                        @php $promotion = json_decode($transaction->promotion); @endphp

                        <div class="discount">
                        <h6>Promo Discount ({{$promotion->discount}}%)</h6>
                        <h5>${{$promotion->discount_amount}}</h5>
                    </div>
                    @endif
                    @if($transaction->gift_voucher)
                        @php $giftVoucher = json_decode($transaction->gift_voucher); @endphp
                    <div class="discount">
                        <h6>Voucher (GC{{$giftVoucher->id}}) Discount ({{$giftVoucher->discount}}%)</h6>
                        <h5>${{$giftVoucher->discount_amount}}</h5>
                    </div>
                    @endif
                    @if($transaction->manual_discount)
                    <div class="discount">
                        <h6>Manual Discount({{$transaction->manual_discount}}%)</h6>
                        <h5>${{($transaction->manual_discount/100)*$cart->total}}</h5>
                    </div>
                    @endif
                    @if($cart->is_birthday_discount)
                    <div class="discount">
                        <h6>Birthday Discount(10%)</h6>
                        <h5>${{$cart->birthday_discount_amount}}</h5>
                    </div>
                    @endif
                    <div class="cart-grand-total">
                        <h6>Grand Total</h6>
                        <h4 class="cart-total-price">${{$cart->grand_total}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

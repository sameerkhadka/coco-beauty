<div class="main">
    @if(count($this->cart['items'])>0)
    <div class="main-content">

        <div class="checkout-box">
            <div class="transaction-box">
                <div class="tb-info">
                    <h4 class="transaction-tb-head">Personal Information</h4>

                    <div class="choose-mem">
                        <label class="cm-card">
                            Member
                            <input type="radio" checked="checked" name="personal-info">
                            <span class="checkmark"></span>
                        </label>

                        <label class="cm-card">
                            Non Member
                            <input type="radio"  name="personal-info">
                            <span class="checkmark"></span>
                        </label>

                    </div>

                    <div class="cart-entries">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Full Name</label>
                                    <input type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Phone</label>
                                    <input type="number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Email</label>
                                    <input type="email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Address</label>
                                    <input type="text">
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
                                    <input type="number">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="entry">
                                    <label >Discount Amount</label>
                                    <input type="number">
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
                    <div class="discount">
                        <h6>Senior Discount</h6>
                        <h5>${{$seniorDiscount}}</h5>
                    </div>
                    <div class="discount">
                        <h6>Manual Discount</h6>
                        <h5>${{$manualDiscount}}</h5>
                    </div>
                    <div class="cart-grand-total">
                        <h6>Grand Total</h6>
                        <h4 class="cart-total-price">${{$grandTotal}}</h4>
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

<script>
    $("#multiple").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });
</script>

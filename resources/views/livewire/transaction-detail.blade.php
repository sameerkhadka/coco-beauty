<div class="main">
    <!-- {{json_encode($transaction)}} -->

    <div class="main-content">
        <div class="trnx-detail">
            <h4>TXN1</h4>
            <h4>Ram Prashad Ghimire</h4>
            <h4>2021-04-12</h4>
        </div>

        <div class="checkout-box">
            <div class="transaction-box">
                <div class="tb-info">
                    <h4 class="transaction-tb-head">Personal Information</h4>

                    <div class="choose-mem">
                        <label class="cm-card">
                            Non Member 
                            <input type="radio" checked="checked" >
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="cart-entries">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Full Name</label>
                                    <input type="text" value="Full Name" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Phone</label>
                                    <input type="number" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Email</label>
                                    <input type="email" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="entry">
                                    <label >Address</label>
                                    <input type="text" readonly>
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
                                    <label>Description</label>
                                    <textarea  readonly></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="entry">
                                    <label >Bandi Color Gel</label>
                                    <input type="text" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="entry">
                                    <label >OPI Gel And Normal</label>
                                    <input type="text" readonly>
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
                            <input type="radio"  checked value="cash" name="payment-method" readonly>
                            <span class="checkmark"></span>
                        </label>

            

                    </div>

                </div>
            </div>

            <div class="cart-wrap">
                <div class="checkout-head">
                    <h4>Service Cart</h4>
                    <p>2 items in this cart </p>
                </div>

                <div class="cart-sing">
                    <div class="cart-ser-des">
                        <h5>Full Set Clear With White Tips</h5>
                        <p>Gel</p>
                    </div>

                    <div class="cart-qty">
                        <input type="number" class="qty-value" value="2" readonly="">
                    </div>

                    <div class="cart-price-total">
                        <h6>$40</h6>
                    </div>

                </div>

                <div class="cart-sing">
                    <div class="cart-ser-des">
                        <h5>Full Set Clear With White Tips</h5>
                        <p>Gel</p>
                    </div>

                    <div class="cart-qty">
                        <input type="number" class="qty-value" value="2" readonly="">
                    </div>

                    <div class="cart-price-total">
                        <h6>$40</h6>
                    </div>

                </div>

                <div class="cart-amount">
                    <div class="cart-total">
                        <h4 class="cart-total-price">$165</h4>
                    </div>
                    <div class="discount">
                        <h6>Promo Discount Discount</h6>
                        <h5>$33</h5>
                    </div>
                    <div class="discount">
                        <h6>Voucher (GC1) Discount</h6>
                        <h5>$130</h5>
                    </div>

                    <div class="discount">
                        <h6>Manual Discount(10%)</h6>
                        <h5>$16.5</h5>
                    </div>
                    
                    <div class="cart-grand-total">
                        <h6>Grand Total</h6>
                        <h4 class="cart-total-price">$214.5</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<div class="main">
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
                    <p>You have 2 items in your cart </p>
                </div>

                <div class="cart-sing">
                    <div class="cart-ser-des">
                        <h5>Full Set Clear With White Tips</h5>
                        <p>Normal</p>
                    </div>
            
                    <div class="cart-qty">
                        <input type="number" class="qty-value" value="1" readonly />
                    </div>

                    <div class="cart-price-total">
                        <h6 >$50</h6>
                    </div>
            
                </div>
                <div class="cart-sing">
                    <div class="cart-ser-des">
                        <h5>Full Set Clear With White Tips</h5>
                        <p>Gel</p>
                        
                    </div>
            
                    <div class="cart-qty">
                        <input type="number" class="qty-value" value="2"  readonly/>
                    </div>

                    <div class="cart-price-total">
                        <h6>$120</h6>
                    </div>
            
                </div>



                <div class='cart-amount'>

                    

                    <div class="cart-total">
                        <h4 class="cart-total-price">$170</h4>
                    </div>

                    <div class="discount">
                        <h6>Senior Discount</h6>   

                        <h5>$17</h5>
                    </div>

                    <div class="discount">
                        <h6>Manual Discount</h6>
                        <h5>$17</h5>
                    </div>

                    <div class="cart-grand-total">
                        <h6>Grand Total</h6>
                        <h4 class="cart-total-price">$150</h4>
                    </div>
                </div>

                <div class="checkout">
                    <a href="#" class="aside-btn">Proceed Transaction</a>
                </div>

                

            </div>
        
        </div>


    
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $("#multiple").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });
</script>
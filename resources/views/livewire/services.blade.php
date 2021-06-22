
    <div class="main">
        <div class="main-content">
            <div class="main-header">
                <h2>Services</h2>

                <div class="mn-right">
                    <a href="#" class="cart-btn" id="aside-btn">
                        Cart
                        <span class="cart-count"> (0) </span>
                    </a>

                </div>
            </div>


            <div class="ser-tab">
                <ul class="nav nav-tabs">
                    @foreach($services as $service)
                    <li class="active">
                        <a data-toggle="tab" href="#{{Str::slug($service->name)}}">
                            <img src="/storage/{{$service->image}}" alt="">
                            <span>{{$service->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="content">
                  <div class="tab-content">
                      @foreach($services as $service)
                          <div id="{{Str::slug($service->name)}}" class="tab-pane fade in">
                              <div class="tab-wrapper">
                                  <div class="row">
                                      @foreach($service->items as $item)
                                      <div class="col-md-6">
                                          <div class="ser-item">
                                              <div class="ser-item-desc">
                                                  <h5 class="service-name">{{$item->name}}</h5>
                                                  <h6 class="service-type">{{$item->type}}</h6>
                                                  <p class="service-price">{{$item->price ? '$'.$item->price : $item->range ?? '-'}}</p>
                                              </div>

                                              <button class='add-to-cart'>
                                                  +
                                              </button>
                                          </div>
                                      </div>
                                      @endforeach
                                  </div>

                              </div>
                          </div>
                      @endforeach
                  </div>
            </div>
        </div>

        <div class="main-aside">
            <div class="cart-head">
                <h4>Cart</h4>

                <button>Clear</button>
            </div>

            <div class="cart-wrap">


            </div>

            <div class="cart-total">
                <h6>Total</h6>
                <h4 class="cart-total-price">$0</h4>
            </div>

            <div class="checkout">
                <a href="{{ route('checkout') }}" class="aside-btn">Checkout</a>
            </div>
        </div>
    </div>





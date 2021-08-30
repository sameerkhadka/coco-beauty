    <div class="main" x-data="{open:false}">
        <div x-bind:class="open ? 'aside-open' : ''" class="main-content">
            <div class="main-header">
                <h2>Services</h2>

                <div class="mn-right">
                    <a href="#" class="cart-btn" x-on:click="open=!open" >
                        Cart
                        <span class="cart-count"> ({{count($cart['items'])}}) </span>
                    </a>

                </div>
            </div>


            <div  class="ser-tab">
                <ul class="nav nav-tabs">
                    @foreach($services as $service)
                    <li >
                        <a class="{{$loop->first ? 'active show' : ''}}" data-toggle="tab" href="#{{Str::slug($service->name)}}">
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
                          <div id="{{Str::slug($service->name)}}" class="tab-pane fade in {{$loop->first ? 'show active' : ''}}">
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
                                           
                                                <a wire:click="addToCart({{$item->id}})" href='#' class='add-to-cart'>
                                                  +
                                                </a>
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

        <div x-bind:class="open ? 'open' : ''" class="main-aside">
            
                @if($memberName)
                    <div class="cart-for">
                        <p><span>Selected Member:</span> {{$memberName}}</p>
                    </div>
                @endif


            <div class="cart-head">
                <h4>Cart</h4>
                
                <button wire:click="emptyCart">Clear</button>
            </div>
            @if(count($cart['items'])>0)
            <div class="cart-wrap">
                @foreach($cart['items'] as $item)
                    <div class="cart-sing">

                        <div class="cart-ser-des">
                            <h5>{{$item['item']['name']}}</h5>
                            <p>{{$item['item']['type'] ?? ''}} </p>
                            <h6 class="cart-price">$<input type="number" class="qty-value" wire:model="cart.items.{{$loop->index}}.item.price"></h6>
                        </div>

                        <div class="cart-qty">
                            <input type="number" class="qty-value" wire:model="cart.items.{{$loop->index}}.quantity">
                        </div>

                        <div class="cart-rem">
                            <button class="cart-del" wire:click="removeItem('{{Crypt::encrypt($item['item']['id'])}}')"><i class="fas fa-times"></i></button>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="cart-total">
                <h6>Total</h6>
                <h4 class="cart-total-price">${{$cart['total']}}</h4>
            </div>
            <div class="checkout">
                <a href="{{ route('checkout') }}" class="aside-btn">Checkout</a>
            </div>
            @else
                <div class="cart-wrat">
                    <p>Your Cart is empty</p>
                </div>
            @endif
        </div>
        <div wire:loading wire:target = "addToCart,emptyCart, removeItem" class="loading">
            <img src="{{asset('images/loading.gif')}}" alt="">
        </div>
    </div>


    <style>

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            padding: 0px 5px;
        }
        .loading img{
            width:60px;
        }
    </style>




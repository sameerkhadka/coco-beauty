
    <div class="main">
        <div class="main-content">


            <div class="main-header">
                <h2>Transaction</h2>
            </div>

            <!-- <div class="search">
                <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
                <i class="fas fa-search"></i>
            </div> -->

            <div class="search-filter filter-flex">
                <div>
                    <a class="{{ $sortDate['type']=='today' ? 'filter-active' : '' }}" href="#"  wire:click="updateSorting('today')">Today</a>
                    <a class="{{ $sortDate['type']=='all' ? 'filter-active' : ''}}" href="#" wire:click="updateSorting('all')">All</a>
                </div>

                @if($sortDate['type']=='all')
                    <div class="date-filter">
                        <div class="date">
                            <label >From</label>
                            <input type="date" wire:model.defer="from">
                        </div>

                        <div class="date">
                            <label >To</label>
                            <input type="date" wire:model.defer="to">
                        </div>

                        <div>
                            <button wire:click="filter">Filter</button>
                        </div>
                    </div>
                @endif
            </div>

            <div class="content">
                <table class="member " id="member">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Transaction By</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>

                            <td>TXN{{$transaction->id}}</td>

                            <td>{{$transaction->full_name}}</td>

                            <td>{{$transaction->created_at->toDateString() }}</td>

                            <td>{{json_decode($transaction->cart)->grand_total}}</td>
                            <td>{{ucfirst($transaction->payment_method)}}</td>

                            <td>
                                <div class="actn-btn">
                                    <a href="{{route('transaction-detail',"id={$transaction->id}")}}" class="view-btn"><i class="far fa-eye"></i></a>
                                    {{--<button class="delete-single"><i class="far fa-trash-alt"></i></button>--}}
                                    @if($transaction->type=='voucher')
                                        <img class="gift-img" src="{{asset('images/card-outline.svg')}}" alt="">
                                    @endif
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="table-footer">
                    <!-- <div class="summary-card">
                        <div class="text">Gift Voucher</div>
<<<<<<< HEAD
                        <div class="amount">${{$gift}}</div>
                    </div>

                    <div class="summary-card">
                        <div class="text">Card</div>
                        <div class="amount">{{$card}}</div>
=======
                        <div class="amount">$300</div>
                    </div> -->

                    <div class="summary-card">
                        <div class="text">Card</div>
                        <div class="amount">${{$card}}</div>
>>>>>>> e1b6bb2616dc07c19fd95872cb025ef2e30d8caa
                    </div>

                    <div class="summary-card">
                        <div class="text">Cash</div>
<<<<<<< HEAD
                        <div class="amount">{{$cash}}</div>
=======
                        <div class="amount">${{$cash}}</div>
>>>>>>> e1b6bb2616dc07c19fd95872cb025ef2e30d8caa
                    </div>


                    <div class="summary-card big">
                        <div class="text">Grand Total</div>
<<<<<<< HEAD
                        <div class="amount">{{$total}}</div>
=======
                        <div class="amount">${{$total}}</div>
>>>>>>> e1b6bb2616dc07c19fd95872cb025ef2e30d8caa
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .search-filter a.filter-active{
            background: #b1b1b4;
            color: #000;
        }
        .loading {
            background: #d6be58;
            position: absolute;
            color: #000001;
            top: 50%;
            left: 48%;
            padding: 0px 5px;
            border: 1px solid #786618;
            font-size: 12px;
            border-radius: 4px;
        }

    </style>

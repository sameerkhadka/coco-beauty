
    <div class="main">
        <div class="main-content">


            <div class="main-header">
                <h2>Transaction</h2>
            </div>

            <div class="search">
                <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
                <i class="fas fa-search"></i>
            </div>

            <div class="search-filter">
                <a class="{{ $sortDate['type']=='today' ? 'filter-active' : '' }}" href="#"  wire:click="updateSorting('today')">Today</a>
                <a class="{{ $sortDate['type']=='tomorrow' ? 'filter-active' : ''}}" href="#" wire:click="updateSorting('tomorrow')">Tomorrow</a>
                <a class="{{ $sortDate['type']=='nextWeek' ? 'filter-active' : '' }}" href="#" wire:click="updateSorting('nextWeek')">Next Week</a>
                <a class="{{ $sortDate['type']=='all' ? 'filter-active' : ''}}" href="#" wire:click="updateSorting('all')">All</a>
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

                            <td>{{$transaction->created_at}}</td>

                            <td>{{json_decode($transaction->cart)->grand_total}}</td>

                            <td>
                                <div class="actn-btn">
                                    <a href="{{route('transaction-detail',"id={$transaction->id}")}}" class="view-btn"><i class="far fa-eye"></i></a>
                                    {{--<button class="delete-single"><i class="far fa-trash-alt"></i></button>--}}
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
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


<div class="main">

        <div class="main-content">
            <div class="main-header">
                <h2>Birthday</h2>
            </div>

            <div class="search">
                <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
                <i class="fas fa-search"></i>
            </div>

            <div class="search-filter" x-data>
                <a class="{{ $sortDate['type']=='thisMonth' ? 'filter-active' : '' }}" href="#"  wire:click="updateSorting('thisMonth')">This Month</a>
                <a class="{{ $sortDate['type']=='lastMonth' ? 'filter-active' : ''}}" href="#" wire:click="updateSorting('lastMonth')">Last Month</a>
                <a class="{{ $sortDate['type']=='nextMonth' ? 'filter-active' : '' }}" href="#" wire:click="updateSorting('nextMonth')">Next Month</a>
            </div>

            <div class="content">
                <table class="member " id="member">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Birthday</th>

                            <th>Birthday Promotion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($members as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </td>

                                <td>{{$item->first_name.' '.$item->last_name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->dob}}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" {{$item->used ? 'checked' : ''}} disabled>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="main-aside">
            <div class="add-mem">
                <h4>New Gift Voucher</h4>

                <div class="addm-sing">
                    <label >Voucher Number</label>
                    <input type="text">
                </div>

                <div class="addm-sing">
                    <label >Gift To</label>
                    <input type="text">
                </div>

                <div class="addm-sing">
                    <label >Amount</label>
                    <input type="number">
                </div>

                <div class="addm-sing">
                    <label >Issued Date</label>
                    <input type="date">
                </div>

                <div class="addm-sing">
                    <label >Expiry Date</label>
                    <input type="date">
                </div>

                <a href="" class="aside-btn">Add Gift Voucher</a>
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

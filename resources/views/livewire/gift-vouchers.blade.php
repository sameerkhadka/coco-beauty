<div>
    <div class="main">
        <div class="main-content">
            <div class="main-header">
                <h2>Gift Card</h2>

                <div class="mn-right">

                    <a href="" class="del-btn">Delete</a>
                    <a href="#" class="new-btn" id="aside-btn">Add New</a>
                </div>
            </div>

            <div class="search">
                <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
                <i class="fas fa-search"></i>
            </div>

            <div class="search-filter">
                <a href="">All</a>
                <a href="">Used</a>
                <a href="">Not Used</a>
            </div>

            <div class="content">
                <table class="member " id="member">
                    <thead>
                        <tr>
                            <th></th>
                            <th>V Num</th>
                            <th>Gift For</th>
                            <th>Amount</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>Used Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>
                            <td>GC001</td>
                            <td>John Will Smith</td>
                            <td>$50</td>
                            <td>2021-08-20</td>
                            <td>2022-02-21</td>
                            <td>Not Used</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>
                            <td>GC002</td>
                            <td>Francisco Chang</td>
                            <td>$100</td>
                            <td>2021-08-20</td>
                            <td>2022-02-21</td>
                            <td>2021-08-22</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
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
</div>

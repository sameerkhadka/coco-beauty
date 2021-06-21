<div>
    <div class="main">
        <div class="main-content">
            <div class="main-header">
                <h2>Promotions</h2>

                <div class="mn-right">

                    <a href="" class="del-btn">Delete</a>
                    <a href="#" class="new-btn" id="aside-btn">Add New</a>
                </div>
            </div>

            <div class="search">
                <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
                <i class="fas fa-search"></i>
            </div>

            <div class="content">
                <table class="member " id="member">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Discount(%)</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>

                            <td>CBLP01</td>

                            <td>Birthday Promotion</td>

                            <td>10</td>

                            <td>
                                <div class="actn-btn">
                                    <a href="" class="edit-btn"><i class="far fa-edit"></i></a>
                                    <button class="delete-single"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>

                            <td>CBLP02</td>

                            <td>Seniors Discount</td>

                            <td>10</td>

                            <td>
                                <div class="actn-btn">
                                    <a href="" class="edit-btn"><i class="far fa-edit"></i></a>
                                    <button class="delete-single"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>

                            <td>CBLP03</td>

                            <td>School Kids Discount</td>

                            <td>10</td>

                            <td>
                                <div class="actn-btn">
                                    <a href="" class="edit-btn"><i class="far fa-edit"></i></a>
                                    <button class="delete-single"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" >
                                <span class="checkmark"></span>
                            </td>

                            <td>CBLP04  </td>

                            <td>Group Discount (4+ customer)</td>

                            <td>10</td>

                            <td>
                                <div class="actn-btn">
                                    <a href="" class="edit-btn"><i class="far fa-edit"></i></a>
                                    <button class="delete-single"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="main-aside">

            <div class="add-mem">
                <h4>New Promotion</h4>

                <div class="addm-sing">
                    <label >Promotion Name</label>
                    <input type="text">
                </div>




                <div class="addm-sing">
                    <label >Discount %</label>
                    <input type="number">
                </div>

                <a href="" class="aside-btn">Add Promotion</a>
            </div>
        </div>
    </div>
</div>

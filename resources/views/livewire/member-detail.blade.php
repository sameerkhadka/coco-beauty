<div class="main">
    <div class="main-content">
        <div class="mem-detail">


                <!-- <h3 ><span class="first-name">Yogesh </span> <span class="last-name">Karki</span></h3>
                <h6>+61 416 422 507</h6>
                <p>6 June 1990</p>
                <p>CBL102</p>
                <p>Surfers Paradise BLVD</p>
                <p>francisschang@gmail.com</p> -->

                <div class="mem-det-top">
                    <div class="profile-image">AB</div>

                    <div class="mem-desc">
                        <h3 ><span class="first-name">{{ $member->first_name }} </span> <span class="last-name">{{ $member->last_name }}</span></h3>
                        <p>{{ $member->phone }}</p>
                        <!-- <div class="reward-point">
                        <i class="fas fa-star"></i> Reward Point <span>105</span>
                        </div> -->
                    </div>
                </div>

                <div class="mem-det-bottom">
                    <div class="mdb-wrap">
                        <p>Member I.D</p>
                        <p>CBL{{ $member->id }}</p>
                    </div>

                    <div class="mdb-wrap">
                        <p>DOB</p>
                        <p>{{ $member->dob ?? '-' }}</p>
                    </div>

                    <div class="mdb-wrap">
                        <p>Address</p>
                        <p>{{ $member->address ?? '-' }}</p>
                    </div>

                    <div class="mdb-wrap">
                        <p>Email</p>
                        <p>{{ $member->email ?? '-' }}</p>
                    </div>
                </div>

                <div class="mem-notify">
                    <p>Full Body Spray Tan(3 pack Deal). Used 1 time</p>
                </div>

        </div>

        <div class="main-header">
            <h2>Transaction</h2>
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
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Action</th>
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

                        <td>{{$transaction->created_at}}</td>

                        <td>{{json_decode($transaction->cart)->grand_total}}</td>

                        <td><textarea name="" >Full Body Spray Tan(3 pack Deal). Used 1 time</textarea>
                            <button>Save</button>
                        </td>

                        <td>
                            <label class="switch">
                                <input type="checkbox"  checked>
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="actn-btn">
                                <a href="{{route('transaction-detail',"id={$transaction->id}")}}" class="view-btn"><i class="far fa-eye"></i></a>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


<script type="text/javascript">

            function profilePicture() {
                var memberFirstName = document.querySelector('.first-name').innerText;
                var memberLastName = document.querySelector('.last-name').innerText;
                var profileImage = document.querySelector('.profile-image');

                if(profileImage) {
                    var initials = memberFirstName.charAt(0) + memberLastName.charAt(0);
                    profileImage.innerHTML = initials ;
                }
            }

            var memberFirstName = document.querySelector('.first-name').innerText;


            profilePicture();
      
</script>
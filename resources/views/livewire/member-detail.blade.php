<div class="main" id="app">
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
                <div wire:ignore>
                    <div class="mem-notify" v-for="item in notifications">
                        <p>@{{item.remarks}}</p>
                    </div>
                </div>


        </div>

        <div class="main-header">
            <h2>Transaction</h2>
        </div>

        <div class="search">
            <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
            <i class="fas fa-search"></i>
        </div>

        <div class="content"  wire:ignore>
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
                    <tr v-for="(item,index) in transactions" :key="index">
                        <td>
                            <input type="checkbox" >
                            <span class="checkmark"></span>
                        </td>

                        <td>TXN@{{ item.id }}</td>

                        <td>@{{item.created_at}}</td>

                        <td>@{{JSON.parse(item.cart).grand_total}}</td>

                        <td v-if="item.status==false || item.status==0">
                            <textarea v-model="item.remarks" ></textarea>
                            <button v-on:click="updateRemarks(item.id,index)">Save</button>
                        </td>
                        <td v-else>@{{ item.remarks }}</td>

                        <td>
                            <input type="checkbox" v-on:input="changeInStatus(item.id,index)" v-model="item.status">

                            <!-- <label class="switch">
                                <input type="checkbox" v-on:input="changeInStatus(item.id,index)" v-model="item.status">
                                <span class="slider round"></span>
                            </label> -->
                        </td>

                        <td>
                            <div class="actn-btn">
                                <a :href="`/transaction-detail?id=${item.id}`" class="view-btn"><i class="far fa-eye"></i></a>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

{{--<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>

@push('scripts')
<script type="text/javascript">
            var app = new Vue({
                el: '#app',
                data: {
                    transactions: @json($transactions),
                    notifications: "",
                },
                mounted(){
                    this.updateNotification()
                },
                watch: {
                    transactions: {
                        handler:function (val) {
                            this.updateNotification()
                        },
                        deep:true
                    },

                },
                methods:{
                    updateNotification(){
                        let transactions = JSON.parse(JSON.stringify(this.transactions))
                        this.notifications = transactions.filter(function(item){
                            return item.remarks!='' && !item.status
                        })
                    },
                    updateRemarks(id,index){
                       @this.updateRemarks(id,this.transactions[index].remarks)
                    },
                    changeInStatus(id,index){
                        @this.updateStatus(id,this.transactions[index].status)
                    }
                }
            })
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
@endpush

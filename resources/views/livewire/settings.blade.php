<div class="main">
    <div class="main-content">
        <div class="main-header" x-data>
            <h2>General Settings</h2>

        </div>

        <!-- <div class="search">
            <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
            <i class="fas fa-search"></i>
        </div> -->
        <div class="content">
            <div class="setting-card">
                <h5>Site Logo</h5>
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <div class="setting-card">
                @if(session('validationErrors'))
                    @foreach(session('validationErrors') as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <h4><span>Email: </span> admin@cocobeauty.com </h4>

                <p>Change Password</p>
                <form action="{{route('changePassword')}}" method="POST">
                    @csrf
                <div class="pass-change">
                    <label >Old Password </label>
                    <input type="password" name="old_password" required>
                </div>

                <div class="pass-change">
                    <label >New Password </label>
                    <input type="password" name="new_password1" required>
                </div>

                <div class="pass-change">
                    <label >Re-enter Password </label>
                    <input type="password" name="new_password2" required>
                </div>

                <div class="pass-change">
                    <button>Change Password</button>
                </div>
                </form>
            </div>
        </div>
    </div>



</div>


<x-guest-layout>
    <section class="login-body">
        <div class="login-wrap">
            <div class="login-form ">
                <div class="lg-head">
                    <img src="./images/logo-icon.png" alt="">
                </div>
                <x-jet-validation-errors />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="login">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-card">
                            <span>E-mail</span>
                            <input class="input-text" type="email" name="email" :value="old('email')" required autofocus>
                        </div>

                        <div class="login-card">
                            <span>Password</span>
                            <input class="input-text" type="password" name="password" required autocomplete="current-password">
                        </div>

                        <div class="login-card">
                            <input type="checkbox" id="remember_me" name="remember">
                            <label for="remember">Remember me</label>
                        </div>

                        <button>Sign In</button>

                    </form>
                </div>
            </div>

            <div class="login-img">
                <img src="./images/coco-bg.jpg" alt="">
            </div>
        </div>
    </section>
</x-guest-layout>

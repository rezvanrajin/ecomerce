@extends('frontend.master')

@section('content')

    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Account</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Login</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                      <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="account-form form-style">
                        <p>User Name or Email Address *</p>
                        <input type="email" name="email">
                        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <p>Password *</p>
                        <input type="Password" name="password">
                                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('redirectToProvider')}}"><i class="fa fa-google-plus"></i>Login With Google</a>
                                                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="password" type="checkbox" name="remeber">
                                <label for="password">Save Password</label>
                            </div>
                            <div class="col-lg-6 text-right">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forget Your Password?</a>
                                @endif
                            </div>
                        </div>
                        <button>SIGN IN</button>
                        <div class="text-center">
                            <a href="{{url('/register')}}">Or Creat an Account</a>
                        </div>
                    </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection

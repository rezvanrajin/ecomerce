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
                            <li><span>Register</span></li>
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
                     <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class="account-form form-style">
                        <p>User Name </p>
                        
                        <input type="text"  name="name">
                                                        @error('name')
                                                        <span class="invalid-feedback" style="display: block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <p>Email Address *</p>
                        <input type="email" name="email">
                                                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      
                        <!--<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>-->
                           <p>Password *</p>
                        <input type="Password" name="password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    
                        <!--<label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>-->
                              <p>Password Confirmation *</p>
                        <input type="Password" name="password_confirmation">
                        <button type="submit">Register</button>
                        <div class="text-center">
                            <a href="login.html">Or Login</a>
                        </div>
                    </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->


@endsection

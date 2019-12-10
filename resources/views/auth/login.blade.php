@extends('layouts.app')
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

body{
   /*  background-color: #ededed !important; */
    background-image: url({{asset('img/slider-bg1.jpeg')}}) ;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
body::before {
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.7); /* Black background with opacity */
    /* background-color: rgba(255,255,255,0.7); */
}
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background-color: rgba(255,255,255,0.8);
  backgroudnd: #e9e9eb;
  max-width: 460px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  border-radius: 5px;
   box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.34);
 }
.form input {
/*   font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 20px;
  height: 50px;
  box-sizing: border-box;
  padding: 15px;
  font-size: 14px; */
  height: 50px;
  margin: 0 0 20px;
  padding: 15px;
  box-sizing: border-box;
  width: 100%;
  border: 0;
  font-size: 14px;
  outline: 0;
  border-radius: 0%;
  background: transparent;
  border-bottom: 1.4px solid #A8A8A8;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #25bf0c;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}

.form button:hover,.form button:active,.form button:focus {
  background: #4ad933;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #000;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  backgrousnd: #2382AB; /* fallback for old browsers */
/*   background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F); */
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
@section('content')
<div class="container">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="form mt-5">
                <div style="background-cgolor: #2382AB;">

                    <img src="./img/login.png" alt="Perfect Logo" class="elevation-3 mb-4"style="opacity: .8"> <br>
            </div>

                <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                <input id="email" type="email"  placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <!--<input class="form-check-input checkk" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-labfel float-left" for="remember">
                            {{ __('Remember Me') }}
                    </label> -->

                <button type="submit">
                        {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn   float-left" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
                </form>
            </div>
        </div>

     </div>
</div>
@endsection




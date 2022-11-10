@extends('layout')

@section('content')
<style> <?php include public_path('css/login_css.css') ?> </style>

<div class="formcontainer">
    <div class="lhead">Login</div>
    <div class="lsubhead">Please login to continue</div>

    <form action="/login" method="POST">
        @csrf
        
        <div class="inputcontainer">
            <input type="email" name="email" value="{{old('email')}}" placeholder="Email"/>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="inputcontainer">
            <input type="password" name="password" value="{{old('password')}}"  placeholder="Password"/>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="rmcontainer">
            {{-- <input id="rm" type="checkbox" name="rememberme">
            <label for="rm"> Remember me</label> --}}

            <span class="fp"><a href="{{route('password.request')}}">Forgot Password?</a></span>
        </div>

        <div class="inputcontainer">
            <button type="submit"  class="loginbtn">Log In</button>
        </div>
        
        <div class="nucontainer">
            <span>New User?</span>
            <span><a href="/register">Sign Up</a></span>
        </div>
    </form>

</div>
@endsection
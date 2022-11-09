@extends('layout')

@section('content')
    <style> <?php include public_path('css/login_css.css') ?> </style>
    
    <div class="formcontainer">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="text" name="token" value="{{$token}}" hidden/>
            
            <div class="inputcontainer">
                <input type="email" name="email" value="{{old('email')}}" placeholder="Email Address"/>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="inputcontainer">
                <input type="password" name="password" value="{{old('password')}}"  placeholder="New Password"/>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="inputcontainer">
                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"  placeholder="Confirm Password"/>
                @error('password_confirmation')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="inputcontainer">
                <button type="submit"  class="loginbtn">Reset Password</button>
            </div>
        </form>
    </div>
@endsection
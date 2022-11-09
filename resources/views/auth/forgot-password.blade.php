@extends('layout')

@section('content')
    <style> <?php include public_path('css/login_css.css') ?> </style>
    <div class="formcontainer">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="inputcontainer">
                <input type="email" name="email" value="{{old('email')}}" placeholder="Email Address"/>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <button type="submit"  class="loginbtn">Password Reset Link</button>
            </div>
        </form>
    </div>
@endsection
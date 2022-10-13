@extends('layout')

@section('content')
<style> <?php include public_path('css/signup_css.css') ?> </style>
    <div class="formcontainer">
        <div class="lhead">Register with LTA</div>
        <div class="lsubhead">Please fill your information</div>
        
        <form action="/expert" method="POST">
            @csrf
            
            <div class="inputcontainer">
                <input type="text" name="name" value="{{old('name')}}" placeholder="Full Name" />
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            
            <div class="inputcontainer">
                <input type="email" name="email" value="{{old('email')}}" placeholder="Email" />
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="tel" name="phone_num" value="{{old('phone_num')}}" placeholder="Phone Number" />
                @error('phone_num')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="text" name="institution_name" value="{{old('institution_name')}}" placeholder="Institution Name" />
                @error('institution_name')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="text" name="reg_num" value="{{old('reg_num')}}" placeholder="Registeration Number" />
                @error('reg_num')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="password" name="password" value="{{old('password')}}" placeholder="Password" />
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <button type="submit" class="signupbtn">Sign Up</button>
            </div>
            
            <div class="nucontainer">
                <span>Already Registered?</span>
                <span><a href="/login">Login</a></span>
            </div>
        </form>
    </div>
@endsection
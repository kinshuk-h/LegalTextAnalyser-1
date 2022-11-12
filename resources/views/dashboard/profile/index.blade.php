@extends('dashboard')

@section('dash-ui')
<script>
    var msg = '{{Session::get('message')}}';
    var exist = '{{Session::has('message')}}';
    if(exist){
      alert(msg);
    }
</script>
<style> <?php include public_path('css/signup_css.css') ?> </style>
    <div class="formcontainer">
        <div class="lhead">Update Your details</div>
        
        <form action="/dashboard/profile/details" method="POST">
            @csrf
            @method('PUT')
            
            <div class="inputcontainer">
                <input type="text" name="name" value="{{old('name',auth()->user()->name) }}" placeholder="Full Name" />
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            
            <div class="inputcontainer">
                <input type="email" name="email" value="{{old('email',auth()->user()->email)}}" placeholder="Email" disabled/>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="tel" name="phone_num" value="{{old('phone_num',auth()->user()->phone_num)}}" placeholder="Phone Number" />
                @error('phone_num')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="text" name="institution_name" value="{{old('institution_name',auth()->user()->institution_name)}}" placeholder="Institution Name" />
                @error('institution_name')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="text" name="reg_num" value="{{old('reg_num',auth()->user()->reg_num)}}" placeholder="Registeration Number" />
                @error('reg_num')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <button type="submit" class="signupbtn">Update</button>
            </div>
        </form>
    </div>

    <div class="formcontainer">
        <div class="lhead">Update Your Password</div>
        
        <form action="/dashboard/profile/password" method="POST">
            @csrf
            @method('PUT')

            <div class="inputcontainer">
                <input type="password" name="old_password" value="{{old('old_password')}}" placeholder="Old Password" />
                @error('old_password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="password" name="new_password" value="{{old('new_password')}}" placeholder="New Password" />
                @error('new_password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <input type="password" name="confirm_new_password" value="{{old('confirm_new_password')}}" placeholder="Confirm New Password" />
                @error('confirm_new_password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="inputcontainer">
                <button type="submit" class="signupbtn">Update</button>
            </div>
        </form>
    </div>

@endsection
@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ Vite::asset('resources/css/style.css') }}" rel="stylesheet">
    @endpush

    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body has-background">
            <div class="container">
                <div class="columns is-centered is-vcentered">
                    <div class="column is-one-third-widescreen is-7 is-12-mobile">
                        <section class="box">
                            <section class="section">
                                <h1 class="title">Register with LTA</h1>
                                <h6 class="subtitle">Create Account to Continue</h6>
                            </section>
                            <form action="/register" method="POST">
                                @csrf
                                
                                <div class="field">
                                    <label class="label">E-Mail Address<span style="color:red;"> *</span></label>
                                    <p class="control is-expanded has-icons-left">
                                        <span class="icon is-small is-left">
                                            <i class="fa fas fa-envelope"></i>
                                        </span>
                                        <input class="input" type="email" name="email" value="{{old('email')}}" placeholder="E-Mail Address"
                                            autofocus="" required>
                                    </p>
                                    @error('email')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Name<span style="color:red;"> *</span></label>
                                    <p class="control is-expanded has-icons-left">
                                        <span class="icon is-small is-left">
                                            <i class="fa fas fa-user"></i>
                                        </span>
                                        <input class="input" type="text" name="name" value="{{old('name')}}" placeholder="Name" autofocus=""
                                            required>
                                    </p>
                                    @error('name')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Phone Number<span style="color:red;"> *</span></label>
                                    <p class="control is-expanded has-icons-left">
                                        <span class="icon is-small is-left">
                                            <i class="fa fas fa-phone"></i>
                                        </span>
                                        <input class="input" type="tel" name="phone_num" value="{{old('phone_num')}}" placeholder="Phone Number"
                                            autofocus="" required>
                                    </p>
                                    @error('phone_num')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Name of the Institution<span style="color:red;"> *</span></label>
                                    <p class="control is-expanded has-icons-left">
                                        <span class="icon is-small is-left">
                                            <i class="fa fas fa-university"></i>
                                        </span>
                                        <input class="input" type="text" name="institution_name" value="{{old('institution_name')}}" 
                                            placeholder="Institution" autofocus="">
                                    </p>
                                    @error('institution_name')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Registration Number<span style="color:red;"> *</span></label>
                                    <p class="control is-expanded has-icons-left">
                                        <span class="icon is-small is-left">
                                            <i class="fa fas fa-id-card"></i>
                                        </span>
                                        <input class="input" type="text" name="reg_num" value="{{old('reg_num')}}" 
                                            placeholder="Registration Number" autofocus="" required>
                                    </p>
                                    @error('reg_num')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Password<span style="color:red;"> *</span></label>
                                    <div class="field has-addons">
                                        <div class="control is-expanded has-icons-left">
                                            <span class="icon is-small is-left">
                                                <i class="fa fas fa-key"></i>
                                            </span>
                                            <input class="input" type="password" name="password" value="{{old('password')}}" 
                                                placeholder="Password" id="password" autofocus="" required>
                                        </div>
                                        <div class="control">
                                            <button class="button" data-visibility data-target="password">
                                                <span class="icon is-small">
                                                    <i class="fa fas fa-eye"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="field">
                                    <label class="label">Confirm Password<span style="color:red;"> *</span></label>
                                    <div class="field has-addons">
                                        <div class="control is-expanded has-icons-left">
                                            <span class="icon is-small is-left">
                                                <i class="fa fas fa-key"></i>
                                            </span>
                                            <input class="input" type="password" name="confirm_password"
                                                placeholder="Confirm Password" id="confirm_password" autofocus=""
                                                required>
                                        </div>
                                        <div class="control">
                                            <button class="button" data-visibility data-target="confirm_password">
                                                <span class="icon is-small">
                                                    <i class="fa fas fa-eye"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="field mt-5">
                                    <p class="control is-expanded">
                                        <button type="submit" class="button is-primary is-fullwidth">
                                            Sign Up
                                        </button>
                                    </p>
                                </div>
                                <div class="field is-grouped is-grouped-centered">
                                    <p class="control">Already Registered?</p>
                                    <p class="control">
                                        <a href="/login">Login</a>
                                    </p>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ Vite::asset('resources/js/login_signup.js') }}"></script>
@endsection
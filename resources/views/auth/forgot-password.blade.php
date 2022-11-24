@extends('layout')

@section('content')
    @push('styles')
    <link href="{{ mix('resources/css/style.css') }}" rel="stylesheet">
    @endpush

    {{-- <script>
        if('{{Session::has('status')}}'){
            alert('{{Session::get('status')}}');
        }
        else if('{{Session::has('email')}}'){
            alert('{{Session::get('email')}}');
        }
    </script> --}}
    @if(Session::has('status') || Session::has('email'))
        <div class="notification is-primary">
            <button class="delete" onclick="this.parentElement.style.display='none'" ></button>
            <div class="buttons is-centered">
                {{Session::get('status') ?: Session::get('email')}}
            </div>
        </div>
    @endif

    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body has-background">
            <div class="container">
                <div class="columns is-centered is-vcentered">
                    <div class="column is-one-third-widescreen is-7 is-12-mobile">
                        <section class="box">
                            <section class="section">
                                <h1 class="title">Forgot Password</h1>
                                <h6 class="subtitle">Get Link to Change Password</h6>
                            </section>
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf

                                <div class="field">
                                    <label class="label">E-Mail Address</label>
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
                                <div class="field mt-5">
                                    <p class="control is-expanded">
                                        <button type="submit" class="button is-primary is-fullwidth">
                                            Password Reset Link
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="{{ mix('resources/js/login_signup.js') }}"></script>
@endsection
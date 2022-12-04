@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ Vite::asset('resources/css/style.css') }}" rel="stylesheet">
    @endpush

    {{-- <script>
        if('{{Session::has('status')}}'){
            alert('{{Session::get('status')}}');
        }
    </script> --}}
    @if(Session::has('status'))
        <div class="notification is-primary">
            <button class="delete" onclick="this.parentElement.style.display='none'" ></button>
            <div class="buttons is-centered">
                {{Session::get('status')}}
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
                                <h1 class="title">Login</h1>
                                <h6 class="subtitle">Continue to Annotator</h6>
                            </section>
                            <form action="/login" method="POST">
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
                                <div class="field">
                                    <label class="label">Password</label>
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
                                <div class="field">
                                    <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                                        {{-- <div class="field">
                                            <input type="checkbox" id="remember" class="is-checkradio is-primary"
                                                name="remember">
                                            <label for="remember">Remember Me</label>
                                        </div> --}}
                                        <div class="field pt-0">
                                            <a href="{{route('password.request')}}">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="field mt-5">
                                    <p class="control is-expanded">
                                        <button type="submit" class="button is-primary is-fullwidth">
                                            LOGIN
                                        </button>
                                    </p>
                                </div>
                                <div class="field is-grouped is-grouped-centered">
                                    <p class="control">New User?</p>
                                    <p class="control">
                                        <a href="/register">Sign Up</a>
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
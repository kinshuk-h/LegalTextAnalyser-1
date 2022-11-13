@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ mix('resources/css/dashboard.css') }}" rel="stylesheet">
    @endpush

    {{-- <div class="maincont">
        <div class="leftsec">
            <div class="hi_name"> Hi, <span class="user_name">{{auth()->user()->name}}</span></div>
            <div class="subsec"> <a href='/dashboard/profile'>Account</a> </div>
            <div class="subsec"> <a href='/dashboard/tasks'>Tasks</a> </div>
            <div class="subsec"> <a href='/dashboard/stats'>Statistics</a> </div>
        </div>
    
        @yield('dash-ui')
        
    </div> --}}

    <section class="side-bar-container block">
        <section class="side-bar has-background-white mt-1 mb-0 ml-1 mr-1">
            <nav class="is-info">
                <p class="panel-heading has-background-info has-text-white">
                    Menu
                </p>
                <a class="panel-block is-active has-text-weight-bold has-text-info" href="/dashboard/profile">
                    <span class="panel-icon">
                        <i class="material-icons" aria-hidden="true">person_outline</i>
                    </span>
                    Profile
                </a>
                <a class="panel-block" href="/dashboard/tasks">
                    <span class="panel-icon">
                        <i class="fa fas fa-book" aria-hidden="true"></i>
                    </span>
                    Tasks
                </a>
                <a class="panel-block" href="/dashboard/stats">
                    <span class="panel-icon">
                        <i class="material-icons" aria-hidden="true">sort</i>
                    </span>
                    Activity
                </a>
            </nav>
        </section>

        @yield('dash-ui')

    </section>

@endsection
@extends('layout')

@section('content')
    {{-- <h3 style="text-align: center;margin: 250px auto;">Dashboard</h3> --}}
    <style> <?php include public_path('css/dashboard_css.css') ?> </style>

    <div class="maincont">
        <div class="leftsec">
            <div class="hi_name"> Hi, <span class="user_name">{{auth()->user()->name}}</span></div>
            <div class="subsec"> <a href='/dashboard'>Account</a> </div>
            <div class="subsec"> <a href='/dashboard/tasks'>Tasks</a> </div>
            <div class="subsec"> <a href='/dashboard/stats'>Statistics</a> </div>
        </div>
    
        @yield('dash-ui')
        
    </div>
@endsection
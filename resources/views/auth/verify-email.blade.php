@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ mix('resources/css/style.css') }}" rel="stylesheet">
    @endpush
<script>
    if('{{Session::has('message')}}'){
        alert('{{Session::get('message')}}');
    }
</script>
<section class="hero is-fullheight-with-navbar">
    <div class="hero-body has-background">
        <div class="container">
            <div class="columns is-centered is-vcentered">
                <form style="border: 2px solid green;padding:10px;background-color:lightgreen;border-radius: 15px;" 
                    method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    
                    <p style="display:inline;font-weight:bold">Please verify your email with link sent to your email.
                    Didn't Received ?
                    <button style="all:unset;display:inline;color:blue;border-radius: 5px;text-decoration: underline;cursor:pointer" 
                        type="submit">Resend Link</button></p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
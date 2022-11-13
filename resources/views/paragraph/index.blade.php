@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ mix('resources/css/annotations.css') }}" rel="stylesheet">
    @endpush
    <script>
        var msg = '{{Session::get('message')}}';
        var exist = '{{Session::has('message')}}';
        if(exist){
            alert(msg);
        }
    </script>
    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body has-background">
            <div class="columns">
                <div class="column is-2"></div>
                <div class="column is-10">
                    <p>
                    <h1 class="pb-6 has-text-weight-bold is-size-3">INSTRUCTIONS</h1>
                    </p>
                    <x-instructions />

                    <a class="button has-background-primary-dark has-text-white has-text-weight-bold mt-6"
                        href="/paragraph/allocate">
                        GET PARAGRAPH
                        <span class="icon">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </span>
                    </a>
                </div>
                <div class="column"></div>
            </div>
        </div>
    </section>
    
@endsection
@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ mix('resources/css/aboutus.css') }}" rel="stylesheet">
    @endpush

    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body has-background">
            <div class="container">
                <div class="columns is-justify-content-center">
                    <div class="column is-6-widescreen is-8-desktop is-10-tablet has-text-centered">
                        <div class="section-title">
                            <h2 id="aboutus" class="mb-4 is-uppercase has-text-weight-bold">About Us</h2>
                        </div>
                    </div>
                </div>
                <div class="columns is-multiline is-justify-content-center">
                    <div class="column is-6-widescreen is-6-tablet">
                        <div class="card px-5 py-6 has-text-centered" data-aos="fade-up" data-aos-delay="100">
                            <i class="ti-desktop text-color text-lg"></i>
                            <h4 class="has-text-weight-bold mb-3 mt-4">Web development</h4>
                            <p>A digital agency isn't here to replace your internal team, we're here to partner</p>
                        </div>
                    </div>
                    <div class="column is-6-widescreen is-6-tablet">
                        <div class="card px-5 py-6 has-text-centered " data-aos="fade-up" data-aos-delay="200">
                            <i class="ti-layers text-color text-lg"></i>
                            <h4 class="has-text-weight-bold mb-3 mt-4 ">Interface Design</h4>
                            <p>A digital agency isn't here to replace your internal team, we're here to partner</p>
                        </div>
                    </div>
                    <div class="column is-6-widescreen is-6-tablet">
                        <div class="card px-5 py-6 has-text-centered " data-aos="fade-up" data-aos-delay="300">
                            <i class="ti-bar-chart text-color text-lg"></i>
                            <h4 class="has-text-weight-bold mb-3 mt-4 ">Business Consulting</h4>
                            <p>A digital agency isn't here to replace your internal team, we're here to partner</p>
                        </div>
                    </div>
                    <div class="column is-6-widescreen is-6-tablet">
                        <div class="card px5 py-6 has-text-centered" data-aos="fade-up" data-aos-delay="200">
                            <i class="ti-vector text-color text-lg"></i>
                            <h4 class="has-text-weight-bold mb-3 mt-4 ">Branding</h4>
                            <p>A digital agency isn't here to replace your internal team, we're here to partner</p>
                        </div>
                    </div>
                    <div class="column is-6-widescreen is-6-tablet">
                        <div class="card px-5 py-6 has-text-centered" data-aos="fade-up" data-aos-delay="300">
                            <i class="ti-android text-color text-lg"></i>
                            <h4 class="has-text-weight-bold mb-3 mt-4 ">App development</h4>
                            <p>A digital agency isn't here to replace your internal team, we're here to partner</p>
                        </div>
                    </div>
                    <div class="column is-6-widescreen is-6-tablet">
                        <div class="card px-5 py-6 has-text-centered" data-aos="fade-up" data-aos-delay="400">
                            <i class="ti-pencil-alt text-color text-lg"></i>
                            <h4 class="has-text-weight-bold mb-3 mt-4 ">Content creation</h4>
                            <p>A digital agency isn't here to replace your internal team, we're here to partner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Essential JavaScripts -->
    <script src="{{ mix('resources/js/aos.js') }}"></script>
    
@endsection



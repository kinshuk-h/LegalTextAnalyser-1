@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ mix('resources/css/style.css') }}" rel="stylesheet">
    @endpush

  <section class="hero is-fullheight-with-navbar">
    <div class="hero-body has-background">
      <div class="columns">
          <div class="column"></div>
          <div class="column is-7 ">
              <p>
              <h1 class="animate__animated animate__fadeInDown pb-6 has-text-weight-bold is-size-3">LABEL THE
                  BEST</h1>
              </p>
              <p>
              <h1 class="animate__animated animate__slideInLeft pb-4 is-size-2" id="ltamain">LEGAL TEXT
                  ANNOTATOR</h1>
              </p>
              <p>
              <h1 class="animate__animated animate__fadeInUp is-size-5">
                  Curating annotated dataset for Text Classification in Indian Legal Judgements
              </h1>
              </p>
              <a class="button has-background-primary-dark has-text-white has-text-weight-bold mt-6"
                  href="/paragraph">
                  GET STARTED
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
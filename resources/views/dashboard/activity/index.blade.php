@extends('dashboard')

@section('dash-ui')
    <article class="content-area">
        <section class="block">
            <section class="hero">
                <p class="panel-heading has-background-info has-text-white mt-1 ml-1 mr-1 mb-0" id="profile">
                    My Statistics
                </p>
            </section>
        </section>
        <article class="container is-fluid mt-1 ml-1 mr-1 mb-0">
            <section class="columns is-vcentered is-centered is-multiline mt-2">
                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h1 class="has-text-weight-semibold is-size-5">Paragraphs Alloted</h1>
                            <h1 class="is-size-6">12</h1>
                        </div>
                    </div>
                </div>
                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h2 class="has-text-weight-semibold is-size-5">Paragraphs Labelled</h2>
                            <h1 class="is-size-6">12</h1>
                        </div>
                    </div>
                </div>

                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h2 class="has-text-weight-semibold is-size-5">Paragraphs Bypassed</h2>
                            <h1 class="is-size-6">12</h1>
                        </div>
                    </div>
                </div>

                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h2 class="has-text-weight-semibold is-size-5">Paragraphs Modified</h2>
                            <h1 class="is-size-6">12</h1>
                        </div>
                    </div>
                </div>

                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h1 class="has-text-weight-semibold is-size-5">Total Labelling Time</h1>
                            <h1 class="is-size-6">1 hr 12 mins</h1>
                        </div>
                    </div>
                </div>

                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h1 class="has-text-weight-semibold is-size-5">Average Labelling Time</h1>
                            <h1 class="is-size-6">1 hr 12 mins</h1>
                        </div>
                    </div>
                </div>

                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h1 class="has-text-weight-semibold is-size-5">Minimum Labelling Time</h1>
                            <h1 class="is-size-6">1 hr 12 mins</h1>
                        </div>
                    </div>
                </div>

                <div class="column is-3-desktop is-3">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <h1 class="has-text-weight-semibold is-size-5">Maximum Labelling Time</h1>
                            <h1 class="is-size-6">1 hr 12 mins</h1>
                        </div>
                    </div>
                </div>

            </section>
            <section class="columns is-vcentered is-centered is-multiline mt-6">
                <div class="column is-4-desktop">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="https://bulma.io/images/placeholders/1280x960.png"
                                    alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Phasellus nec iaculis mauris.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-offset-2-desktop is-4-desktop">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="https://bulma.io/images/placeholders/1280x960.png"
                                    alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Phasellus nec iaculis mauris.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </article>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
@endsection
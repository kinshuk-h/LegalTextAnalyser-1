@extends('layout')

@section('content')
    @push('styles')
        <link href="{{ mix('resources/css/paragraphs.css') }}" rel="stylesheet">
    @endpush

    {{-- Actual content --}}

    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body m-0 pb-0 pt-2">
            <div class="container">
                <div class="columns is-justify-content-center">
                    <div class="column has-text-centered">
                        <div class="section-title">
                            <!-- Modal HTML content(hidden by default) starts here -->
                            <div class="modal p-2" id="modal1">
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                        <p class="modal-card-title has-text-info-dark">Instructions</p>
                                        <button class="delete" aria-label="close"></button>
                                    </header>
                                    <section class="modal-card-body has-text-left">
                                        
                                        <x-instructions />

                                    </section>
                                </div>
                            </div>
                            <!-- Modal button for trigger -->
                            <button class="button is-text has-text-info has-text-weight-bold js-modal-trigger"
                                data-target="modal1">
                                Instructions
                            </button>
                        </div>
                    </div>
                    <div class="column has-text-centered">
                        <div class="section-title">
                            <h2 class="mb-4 mt-2">
                                <b>Font Size</b>
                                <input type="range" id="font-size-slider" min="20" max="40" />
                            </h2>
                        </div>
                    </div>
                    <div class="column">
                        <div class="section-title has-text-centered">
                            <h2 class="mb-4 mt-2">
                                <span>🕒<b>Time Remaining:</b></span>
                                <span id="clock"></span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="tile is-ancestor ">
                    <div class="tile is-vertical is-8">
                        <div class="tile is-parent">
                            <article id="paragraph-content" class="tile is-child notification has-background-success-light">
                                <p class="title">Your Paragraph Here</p>
                                <div class="content">
                                    <p class="subtitle has-text-info">Details of the <a href={{ $message['document']->document_link }}>Document</a></p>
                                    <strong>Document Number: </strong><span>{{ $message['document']->doc_id }}</span><br>
                                    <strong>Case Number: </strong><span>{{ $message['document']->case_number }}</span><br>
                                    <strong>Title: </strong><span>{{ $message['document']->title }}</span><br>
                                    <strong>Date of the Judgement: </strong><span>{{ $message['document']->date }}</span><br>
                                    <strong>Page Number: </strong><span>{{ $message['paragraph']->page }}</span><br>
                                    <strong>Paragraph Number: </strong><span>{{ $message['paragraph']->paragraph_num }}</span><br>
                                </div>
                                <div class="content scrollable">
                                    {{ $message['paragraph']->content }}
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child has-background-danger-light notification">
                            <div class="content rows">
                                <div>
                                    <p class="title is-3">Labels</p>
                                    <p class="subtitle">You can select multiple labels</p>
                                </div>
                                <form action="/paragraph/label" method="POST">
                                    @csrf

                                    <div id="labelcontainer" class="content is-fullheight">
                                        <div class="checkitems">
                                            @foreach ($labels as $label)
                                                <div class="checkitem">
                                                    <input type="checkbox" id={{"label-".$label->label_num}} class="is-checkradio is-link"
                                                        name="labels[]"  value="{{$label->label_num}}" />
                                                    <label for={{"label-".$label->label_num}}><span
                                                            class="has-tooltip-arrow has-tooltipl-multiline has-tooltip-info"
                                                            data-tooltip="Tooltip content&#10;tooltip content">{{$label->label_name}}</span></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="buttons is-centered">
                                        @error('labels')
                                            <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="buttons is-centered">
                                        <button type="submit" class="button is-primary js-modal-trigger" id="change_passwd"
                                            data-target="paragraph1-modal">SUBMIT</button>
                                    </div>
                                </form>
                                <form action="/paragraph/bypass" method="POST">
                                    @csrf

                                    <input type="radio" name="bypass" value="true" hidden checked>
                                    
                                    <button type="submit" class="button is-light js-modal-trigger" id="change_passwd"
                                        data-target="paragraph2-modal">SKIP</button>
                                </form>
                            </div>
                        </article>
                    </div>
                </div>

                {{-- <div class="modal" id="paragraph1-modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head has-text-centered">
                            <p class="modal-card-title has-text-success-dark has-text-weight-bold">Paragraph has
                                been labelled.</p>
                        </header>

                        <section class="modal-card-body has-text-centered">
                            <div class="container is-fluid">
                                <b>Do you want to label next?</b>
                                <div class="field is-grouped is-grouped-centered mt-5">
                                    <div class="control">
                                        <a class="button is-primary" href="paragraphs.html">YES</a>
                                    </div>

                                    <div class="control">
                                        <a class="button is-light" href="annotations.html">NO</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="modal" id="paragraph2-modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head has-text-centered">
                            <p class="modal-card-title has-text-info-dark has-text-weight-bold">Paragraph has been
                                bypassed.</p>
                        </header>

                        <section class="modal-card-body has-text-centered">
                            <div class="container is-fluid">
                                <b>Do you want to label next?</b>
                                <div class="field is-grouped is-grouped-centered mt-5">
                                    <div class="control">
                                        <a class="button is-primary" href="paragraphs.html">YES</a>
                                    </div>
                                    <div class="control">
                                        <a class="button is-light" href="annotations.html">NO</a>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <script src="{{ mix('resources/js/modal.js') }}"></script>
    <script type="text/javascript">
        let meta= {!! json_encode($message['allocation']) !!};
        let alloc_time= new Date(meta.allocation_time);
        let deadline = alloc_time.setTime(alloc_time.getTime() + 1 * 60 * 60 * 1000);
        
        var interval=setInterval(function() {
            let now = new Date().getTime();
            let t = deadline - now;
            let hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
            let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((t % (1000 * 60)) / 1000);
            document.getElementById("clock").innerText = hours + "h " + minutes + "m " + seconds + "s ";
            if (t < 0) {
                clearInterval(interval);
                document.getElementById("clock").innerText = "Time's Up";
            }
        }
        , 1000);

        let slider = document.getElementById("font-size-slider");
        slider.addEventListener('input', function(event) {
            document.getElementById("paragraph-content").style.fontSize = event.target.value+"px";
        });

    </script>
    
@endsection
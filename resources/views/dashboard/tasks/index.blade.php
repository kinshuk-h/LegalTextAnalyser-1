@extends('dashboard')

@section('dash-ui')
    @push('styles')
        <link href="{{ mix('resources/css/paragraphs.css') }}" rel="stylesheet">
    @endpush

    <article class="content-area ">
        <article class="container">
            <section class="block">
                <section class="hero has-background-info mt-1 ml-1 mr-1 mb-0">
                    <nav class="level">
                        <div class="level-left">
                            <p class="panel-heading has-background-info has-text-white">
                                My Tasks/ Annotated Paragraphs
                            </p>
                        </div>

                        <div class="level-right mr-1">
                            <div class="control has-icons-left mr-2">
                                <form method="GET" action='/dashboard/tasks/filter' class="select">
                                    <select onchange="this.form.submit()" name="filterBy">
                                        <option disabled selected hidden>Filter by..</option>
                                        <option {{ $selected == 'all' ? "selected" : "" }} value="all">All</option>
                                        <option {{ $selected == 'labeled' ? "selected" : "" }} value="labeled">Labelled</option>
                                        <option {{ $selected == 'modified' ? "selected" : "" }} value="modified">Modified</option>
                                        <option {{ $selected == 'bypass' ? "selected" : "" }} value="bypass">Bypassed</option>
                                        <option {{ $selected == 'timesup' ? "selected" : "" }} value="timesup">Time's Up</option>
                                        @foreach ($labels as $label)
                                            <option {{ $selected == $label['label_num'] ? "selected" : "" }} value={{$label['label_num']}}>{{$label['label_name']}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <div class="icon is-left">
                                    <i class="fa fas fa-sort"></i>
                                </div>
                            </div>


                            <form method="GET" action='/dashboard/tasks/search' class="field has-addons">

                                <div class="control is-fluid">
                                    <input class="input" type="search" name="searchBy" value="{{Request::get('searchBy')}}" placeholder="Search by Title/Case No./Content" required>
                                </div>
                                <div class="control">
                                    <button type="submit" class="button is-grey">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>
                    </nav>
                </section>
            </section>

            <article class="container is-fluid p-1">
                @if ($tasks->total()>0)
                    @foreach ($tasks as $task)
                        <!-- Paragraphs -->
                        <section class="box ">
                            <section class="block">
                                {{substr($task->content,0,81)}}
                                <span class="dots">...</span>
                                <span class="more">
                                    {{substr($task->content,81)}}
                                </span>
                                <a class="read is-text has-text-link p-0">
                                    <span>Read More</span>
                                </a>
                            </section>
                            <div class="columns is-vcentered">
                                <div class="column is-narrow">
                                    <span class="tag is-info is-light is-medium">
                                        {{$task->status}}
                                    </span>
                                </div>
                                <div class="column">
                                    <div class="tags is-multiline">
                                        @if($task->label_num !== null)
                                            @foreach (explode(",",$task->label_num) as $label_num)
                                                <span class="tag is-primary is-light is-medium">
                                                    {{$labels[$label_num]['label_name']}}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    @if($task->label_num !== null)
                                        <button class="button is-primary js-modal-trigger" 
                                        data-target={{"label_details-".$task->doc_id."-".$task->paragraph_num}}>
                                            <span class="icon is-small">
                                                <i class="fa fas fa-edit"></i>
                                            </span>
                                            <span>Modify</span>
                                        </button>
                                    @endif

                                    <button class="button is-info has-text-white has-text-weight-bold js-modal-trigger"
                                    data-target={{"modal_details-".$task->doc_id."-".$task->paragraph_num}}>
                                        <span class="icon is-small">
                                            <i class="fa fas fa-eye"></i>
                                        </span>
                                        <span>Paragraph Details</span>
                                    </button>
                                </div>
                            </div>
                        </section>
                        {{-- Modify Modal --}}
                        @if($task->label_num !== null)
                            <div class="modal p-2" id={{"label_details-".$task->doc_id."-".$task->paragraph_num}}>
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                        <p class="modal-card-title has-text-info-dark">Labels</p>
                                        <button class="delete" aria-label="close"></button>
                                    </header>
                                    <section class="modal-card-body has-text-left">
                                        <p class="subtitle has-text-info">You can select multiple labels</p>
                                        <form action="/dashboard/tasks/modify-labels" method="POST" id={{"labelcontainer-".$task->doc_id."-".$task->paragraph_num}} class="content is-fullheight">
                                            @csrf
                                            @method('PUT')

                                            
                                            <input type="number" name="doc_id" value={{$task->doc_id}} hidden>
                                            
                                            <input type="number" name="paragraph_num" value={{$task->paragraph_num}} hidden>

                                            <div class="content rows">
                                                <div class="checkitems">
                                                    @foreach ($labels as $label)
                                                        <div class="checkitem">
                                                            <input type="checkbox" id={{"labelcontainer-".$task->doc_id."-".$task->paragraph_num."-label-".$label['label_num']}} class="is-checkradio is-link"  value={{$label['label_num']}}
                                                                name="labels[]" {{ in_array($label['label_num'] , explode(",",$task->label_num)) ? "checked" : "" }}/>
                                                            <label for={{"labelcontainer-".$task->doc_id."-".$task->paragraph_num."-label-".$label['label_num']}}><span
                                                                    class="has-tooltip-arrow has-tooltipl-multiline has-tooltip-info"
                                                                    data-tooltip="Tooltip content&#10;tooltip content">{{$label['label_name']}}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('labels')
                                                <script>alert('{{ $message }}')</script>
                                            @enderror

                                            <div class="buttons is-centered">
                                                <button class="button is-primary" id={{"labelcontainer-".$task->doc_id."-".$task->paragraph_num."-para_annotate"}} type="submit">SUBMIT</button>
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        @endif
                        <!-- MODAL_DETAILS -->
                        <div class="modal p-2" id={{"modal_details-".$task->doc_id."-".$task->paragraph_num}}>
                            <div class="modal-background"></div>
                            <div class="modal-card">
                                <header class="modal-card-head">
                                    <p class="modal-card-title has-text-info-dark">Paragraph Details</p>
                                    <button class="delete" aria-label="close"></button>
                                </header>
                                <section class="modal-card-body has-text-left">
                                    <p class="subtitle has-text-info"><a href={{$task->document_link}} target="_blank" rel="noopener noreferrer">Document Link</a></p>
                                        <strong>Document Number: </strong><span>{{$task->doc_id}}</span><br>
                                        <strong>Paragraph Number: </strong><span>{{$task->paragraph_num}}</span><br>
                                        <strong>Case Number: </strong><span>{{$task->case_number}}</span><br>
                                        <strong>Title: </strong><span>{{$task->title}}</span><br>
                                        <strong>Page Number: </strong><span>{{$task->page}}</span><br>
                                        <strong>Date of the Judgement: </strong><span>{{$task->date}}</span><br>
                                        <strong>Allocation time: </strong><span>{{$task->allocation_time}}</span><br>
                                        @if(strcmp($task->status,"labeled")==0)
                                            <strong>Labeled time: </strong><span>{{$task->labeled_time}}</span><br>
                                        @endif
                                </section>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination Nav -->
                    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                        <a class="pagination-previous has-background-white" href={{$tasks->previousPageUrl()}}>
                            <span class="icon is-small">
                                <i class="fa fas fa-chevron-left"></i>
                            </span>
                        </a>
                        <a class="pagination-next has-background-white" href={{$tasks->nextPageUrl()}}>
                            <span class="icon is-small">
                                <i class="fa fas fa-chevron-right"></i>
                            </span>
                        </a>
                        <ul class="pagination-list">
                            <li><a class="pagination-link has-background-white" aria-label="Goto page 1" href={{$tasks->url(1)}}>1</a></li>
                            <li><span class="pagination-ellipsis">&hellip;</span></li>
                            {{-- <li><a class="pagination-link has-background-white" aria-label="Goto page 45" href={{$tasks->previousPageUrl()}}>45</a>
                            </li> --}}
                            <li><a class="pagination-link is-current" aria-label={{"Page ".$tasks->currentPage()}}
                                    aria-current="page" href={{$tasks->url($tasks->currentPage())}}>{{$tasks->currentPage()}}</a></li>
                            {{-- <li><a class="pagination-link has-background-white" aria-label="Goto page 47" href={{$tasks->nextPageUrl()}}>47</a>
                            </li> --}}
                            <li><span class="pagination-ellipsis">&hellip;</span></li>
                            <li><a class="pagination-link has-background-white" aria-label={{"Goto page ".$tasks->lastPage()}} href={{$tasks->url($tasks->lastPage())}}>{{$tasks->lastPage()}}</a>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="columns is-vcentered is-centered">
                        <p class="has-text-danger">Nothing to display.</p>
                    </div>
                @endif
            </article>
        </article>
    </article>

    <!--jQuery CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="{{ mix('resources/js/readmore.js') }}"></script>
    <script src="{{ mix('resources/js/modal.js') }}"></script>
@endsection
@extends('dashboard')

@section('dash-ui')
    @push('styles')
        <link href="{{ mix('resources/css/tables.css') }}" rel="stylesheet">
    @endpush
    <article class="content-area ">
        <article class="container">
        <section class="block">
            <section class="hero has-background-info mt-1 ml-1 mr-1 mb-0">
            <nav class="level">
                <div class="level-left">
                <p class="panel-heading has-background-info has-text-white">
                    Documents Log
                </p>
                </div>

                {{-- <div class="level-right mr-1">
                <div class="field has-addons">
                    <div class="control is-fluid">
                    <input class="input" type="text" placeholder="Search by...">
                    </div>
                    <div class="control">
                    <a class="button is-grey">
                        Search
                    </a>
                    </div>
                </div>
                </div> --}}
            </nav>
            </section>
        </section>
        <article class="container is-fluid p-1">
            <!-- DOCUMENTS -->
            <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-database"></i></span>
                DOCUMENTS
                </p>
                <a href="#" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>
            <div class="card-content p-0">
                <div class="table-wrapper has-mobile-cards p-6">
                <table class="table is-fullwidth is-striped is-hoverable has-text-left">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Document Name</th>
                        <th><span class="has-tooltip-arrow has-tooltipl-multiline has-tooltip-info"
                            data-tooltip="Total Number of Paragraphs">P.No</abbr></th>
                        <th><span class="has-tooltip-arrow has-tooltipl-multiline has-tooltip-info"
                            data-tooltip="Total Number of Paragraphs Labelled">L.No</abbr></th>
                        <th><span class="has-tooltip-arrow has-tooltipl-multiline has-tooltip-info"
                            data-tooltip="Total Number of Paragraphs Bypassed">B.No</abbr></th>
                        <th><span class="has-tooltip-arrow has-tooltipl-multiline has-tooltip-info"
                            data-tooltip="Total Number of Paragraphs Times Up">T.No</abbr></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($docs_count_data as $data)
                            <tr>
                                <td width="5%">{{$data->doc_id}}</td>
                                <td data-label="Name">{{$data->title}}</td>
                                <td data-label="P.No">{{$data->PNo}}</td>
                                <td data-label="L.No">{{$data->LNo}}</td>
                                <td data-label="B.No">{{$data->BNo}}</td>
                                <td data-label="T.No">{{$data->TNo}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

            <!-- Pagination Nav -->
            <nav class="pagination is-centered mt-4" role="navigation" aria-label="pagination">
                <a class="pagination-previous has-background-white" href={{$docs_count_data->previousPageUrl()}}>
                    <span class="icon is-small">
                        <i class="fa fas fa-chevron-left"></i>
                    </span>
                </a>
                <a class="pagination-next has-background-white" href={{$docs_count_data->nextPageUrl()}}>
                    <span class="icon is-small">
                        <i class="fa fas fa-chevron-right"></i>
                    </span>
                </a>
                <ul class="pagination-list">
                    <li><a class="pagination-link has-background-white" aria-label="Goto page 1" href={{$docs_count_data->url(1)}}>1</a></li>
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    {{-- <li><a class="pagination-link has-background-white" aria-label="Goto page 45" href={{$docs_count_data->previousPageUrl()}}>45</a>
                    </li> --}}
                    <li><a class="pagination-link is-current" aria-label={{"Page ".$docs_count_data->currentPage()}}
                            aria-current="page" href={{$docs_count_data->url($docs_count_data->currentPage())}}>{{$docs_count_data->currentPage()}}</a></li>
                    {{-- <li><a class="pagination-link has-background-white" aria-label="Goto page 47" href={{$docs_count_data->nextPageUrl()}}>47</a>
                    </li> --}}
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    <li><a class="pagination-link has-background-white" aria-label={{"Goto page ".$docs_count_data->lastPage()}} href={{$docs_count_data->url($docs_count_data->lastPage())}}>{{$docs_count_data->lastPage()}}</a>
                    </li>
                </ul>
            </nav>
            </div>
        </article>
        </article>
    </article>
@endsection
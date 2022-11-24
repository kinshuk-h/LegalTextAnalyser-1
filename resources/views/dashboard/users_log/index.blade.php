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
                    Users Log
                </p>
                </div>

                <div class="level-right">
                <div class="control has-icons-left mr-1">
                    <div class="select">
                    <select>
                        <option disabled selected hidden>Filter by..</option>
                        <option>All Users</option>
                        <option>Active Users</option>
                        <option>Inactive Users</option>
                        <option>Dormant Users</option>
                        <option>Non-Dormant Users</option>
                        <option>Top 10 Users</option>
                    </select>
                    </div>
                    <div class="icon is-left">
                    <i class="fa fas fa-filter"></i>
                    </div>
                </div>
                </div>
            </nav>
            </section>
        </section>

        <article class="container is-fluid p-1">
            <!-- USERS -->
            <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account-group"></i></span>
                EXPERTS
                </p>
                <a href="/dashboard/users-log" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>

            <div class="card-content">
                <div class="b-table has-pagination">
                <div class="table-wrapper has-mobile-cards">
                    <table class="table is-fullwidth is-striped is-hoverable has-text-left">
                    <thead>
                        <tr>
                        {{-- <th></th> --}}
                        <th>E.ID.</th>
                        <th>Name</th>
                        <th>Paragraphs Alloted</th>
                        <th>Paragraphs Labelled</th>
                        <th>Paragraphs Modified</th>
                        <th>Paragraphs Bypassed</th>
                        <th>Paragraphs Time's Up</th>
                        <th>Total Labelling Time</th>
                        <th>Average Labelling Time</th>
                        <th>Minimum Labelling Time</th>
                        <th>Maximum Labelling Time</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($counts_data as $data)
                            <tr>
                                {{-- <td class="is-checkbox-cell">
                                    <label class="b-checkbox checkbox">
                                    <input type="checkbox" value="false">
                                    <span class="check"></span>
                                    </label>
                                </td> --}}
                                <td>{{$data->id}}</td>
                                <td data-label="Name">{{$data->name}}</td>
                                <td data-label="Paragraphs Alloted">{{$data->counts['total alloted']}}</td>
                                <td data-label="Paragraphs Labelled">{{$data->counts['labeled']}}</td>
                                <td data-label="Paragraphs Modified">{{$data->counts['modified']}}</td>
                                <td data-label="Paragraphs Bypassed">{{$data->counts['bypass']}}</td>
                                <td data-label="Paragraphs Time's Up">{{$data->counts['timesup']}}</td>
                                <td data-label="Total Labelling Time">{{$data->Total_Labelling_Time}}</td>
                                <td data-label="Average Labelling Time">{{$data->Average_Labelling_Time}}</td>
                                <td data-label="Minimum Labelling Time">{{$data->Minimum_Labelling_Time}}</td>
                                <td data-label="Maximum Labelling Time">{{$data->Maximum_Labelling_Time}}</td>
                                <td class="is-actions-cell">
                                    <div class="buttons is-right">
                                    <button class="button is-small is-primary" type="button">
                                        <span class="icon"><i class="mdi mdi-eye"></i></span>
                                    </button>
                                    <button class="button is-small is-danger jb-modal" data-target="sample-modal"
                                        type="button">
                                        <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                    </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        
                    </tbody>
                    </table>
                </div>
                </div>
            </div>

            <!-- Pagination Nav -->
            <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                <a class="pagination-previous has-background-white" href={{$counts_data->previousPageUrl()}}>
                    <span class="icon is-small">
                        <i class="fa fas fa-chevron-left"></i>
                    </span>
                </a>
                <a class="pagination-next has-background-white" href={{$counts_data->nextPageUrl()}}>
                    <span class="icon is-small">
                        <i class="fa fas fa-chevron-right"></i>
                    </span>
                </a>
                <ul class="pagination-list">
                    <li><a class="pagination-link has-background-white" aria-label="Goto page 1" href={{$counts_data->url(1)}}>1</a></li>
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    {{-- <li><a class="pagination-link has-background-white" aria-label="Goto page 45" href={{$counts_data->previousPageUrl()}}>45</a>
                    </li> --}}
                    <li><a class="pagination-link is-current" aria-label={{"Page ".$counts_data->currentPage()}}
                            aria-current="page" href={{$counts_data->url($counts_data->currentPage())}}>{{$counts_data->currentPage()}}</a></li>
                    {{-- <li><a class="pagination-link has-background-white" aria-label="Goto page 47" href={{$counts_data->nextPageUrl()}}>47</a>
                    </li> --}}
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    <li><a class="pagination-link has-background-white" aria-label={{"Goto page ".$counts_data->lastPage()}} href={{$counts_data->url($counts_data->lastPage())}}>{{$counts_data->lastPage()}}</a>
                    </li>
                </ul>
            </nav>
            </div>
        </article>
        </article>
    </article>
@endsection
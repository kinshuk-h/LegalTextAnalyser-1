@extends('dashboard')

@section('dash-ui')
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
                                <div class="select">
                                    <select>
                                        <option disabled selected hidden>Filter by..</option>
                                        <option>All</option>
                                        <option>Labelled</option>
                                        <option>Modified</option>
                                        <option>Bypassed</option>
                                        <option>Label 1</option>
                                        <option>Label 2</option>
                                        <option>Label 3</option>
                                        <option>Label 4</option>
                                        <option>Label 5</option>
                                        <option>Label 6</option>
                                        <option>Label 7</option>
                                        <option>Label 8</option>
                                        <option>Label 9</option>
                                        <option>Label 10</option>
                                        <option>Label 11</option>
                                        <option>Label 12</option>
                                    </select>
                                </div>
                                <div class="icon is-left">
                                    <i class="fa fas fa-sort"></i>
                                </div>
                            </div>


                            <div class="field has-addons">
                                <div class="control is-fluid">
                                    <input class="input" type="text" placeholder="Search by Name">
                                </div>
                                <div class="control">
                                    <a class="button is-grey">
                                        Search
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </section>
            </section>

            <!-- <section>
                <aside>
                    <nav class="navbar has-shadow mt-1 ml-1 mr-1 mb-0">
                        <div class="container">
                            <div class="navbar-brand">
                                <span class="navbar-burger" data-target="navbarMenuHeroC1">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </div>
                            <div id="navbarMenuHeroC1" class="navbar-menu">
                                <div class="navbar-start" style="flex-grow: 1; justify-content: center;">
                                    <a class="button is-white">All</a>
                                    <a class="button is-white">Labelled</a>
                                    <a class="button is-white">Modified</a>
                                    <a class="button is-white">Bypassed</a>
                                    <a class="button is-white">Label 1</a>
                                    <a class="button is-white">Label 2</a>
                                    <a class="button is-white">Label 3</a>
                                    <a class="button is-white">Label 4</a>
                                    <a class="button is-white">Label 5</a>
                                    <a class="button is-white">Label 6</a>
                                    <a class="button is-white">Label 7</a>
                                    <a class="button is-white">Label 8</a>
                                    <a class="button is-white">Label 9</a>
                                    <a class="button is-white">Label 10</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </aside>
            </section> -->
            <article class="container is-fluid p-1">
                <!-- Paragraphs -->
                <section class="box ">
                    <section class="block">
                        Lorem ipsum dolor sit amet, ne sed idque quidam. Vim assum corpora an Pro ut erat
                        consetetur, vocent expetendis sit at. Posse populo no usu
                        <span class="dots">...</span>
                        <span class="more">
                            Pro ut erat consetetur, vocent expetendis sit at. Posse populo no usu, nam elit
                            postea nusquam id. Ad nec unum velit, ad lorem primis officiis vis. Eam appareat
                            pericula consequuntur an, atqui saperet his eu, cum prompta fabellas interpretaris
                            et.
                        </span>
                        <button class="read is-text has-text-link p-0">
                            <span>Read More</span>
                        </button>
                    </section>
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <span class="tag is-info is-light is-medium">
                                MODIFIED
                            </span>
                        </div>
                        <div class="column">
                            <div class="tags is-multiline">
                                <span class="tag is-primary is-light is-medium">
                                    Label 1
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 2
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 3
                                </span>
                            </div>
                        </div>
                        <div class="column is-narrow">
                            <button class="button is-primary">
                                <span class="icon is-small">
                                    <i class="fa fas fa-edit"></i>
                                </span>
                                <span>Modify</span>
                            </button>
                        </div>
                    </div>
                </section>
                <section class="box">
                    <section class="block">
                        Lorem ipsum dolor sit amet, ne sed idque quidam. Vim assum corpora an Pro ut erat
                        consetetur, vocent expetendis sit at. Posse populo no usu
                        <span class="dots">...</span>
                        <span class="more">
                            Pro ut erat consetetur, vocent expetendis sit at. Posse populo no usu, nam elit
                            postea nusquam id. Ad nec unum velit, ad lorem primis officiis vis. Eam appareat
                            pericula consequuntur an, atqui saperet his eu, cum prompta fabellas interpretaris
                            et.
                        </span>
                        <button class="read is-text has-text-link p-0">
                            <span>Read More</span>
                        </button>
                    </section>
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <span class="tag is-info is-light is-medium">
                                LABELLED
                            </span>
                        </div>
                        <div class="column">
                            <div class="tags is-multiline">
                                <span class="tag is-primary is-light is-medium">
                                    Label 1
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 2
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 3
                                </span>
                            </div>
                        </div>
                        <div class="column is-narrow">
                            <button class="button is-primary">
                                <span class="icon is-small">
                                    <i class="fa fas fa-edit"></i>
                                </span>
                                <span>Modify</span>
                            </button>
                        </div>
                    </div>
                </section>
                <section class="box">
                    <section class="block">
                        Lorem ipsum dolor sit amet, ne sed idque quidam. Vim assum corpora an Pro ut erat
                        consetetur, vocent expetendis sit at. Posse populo no usu
                        <span class="dots">...</span>
                        <span class="more">
                            Pro ut erat consetetur, vocent expetendis sit at. Posse populo no usu, nam elit
                            postea nusquam id. Ad nec unum velit, ad lorem primis officiis vis. Eam appareat
                            pericula consequuntur an, atqui saperet his eu, cum prompta fabellas interpretaris
                            et.
                        </span>
                        <button class="read is-text has-text-link p-0">
                            <span>Read More</span>
                        </button>
                    </section>
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <span class="tag is-info is-light is-medium">
                                MODIFIED
                            </span>
                        </div>
                        <div class="column">
                            <div class="tags is-multiline">
                                <span class="tag is-primary is-light is-medium">
                                    Label 1
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 2
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 3
                                </span>
                            </div>
                        </div>
                        <div class="column is-narrow">
                            <button class="button is-primary">
                                <span class="icon is-small">
                                    <i class="fa fas fa-edit"></i>
                                </span>
                                <span>Modify</span>
                            </button>
                        </div>
                    </div>
                </section>
                <section class="box">
                    <section class="block">
                        Lorem ipsum dolor sit amet, ne sed idque quidam. Vim assum corpora an Pro ut erat
                        consetetur, vocent expetendis sit at. Posse populo no usu
                        <span class="dots">...</span>
                        <span class="more">
                            Pro ut erat consetetur, vocent expetendis sit at. Posse populo no usu, nam elit
                            postea nusquam id. Ad nec unum velit, ad lorem primis officiis vis. Eam appareat
                            pericula consequuntur an, atqui saperet his eu, cum prompta fabellas interpretaris
                            et.
                        </span>
                        <button class="read is-text has-text-link p-0">
                            <span>Read More</span>
                        </button>
                    </section>
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <span class="tag is-info is-light is-medium">
                                MODIFIED
                            </span>
                        </div>
                        <div class="column">
                            <div class="tags is-multiline">
                                <span class="tag is-primary is-light is-medium">
                                    Label 1
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 2
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 3
                                </span>
                            </div>
                        </div>
                        <div class="column is-narrow">
                            <button class="button is-primary">
                                <span class="icon is-small">
                                    <i class="fa fas fa-edit"></i>
                                </span>
                                <span>Modify</span>
                            </button>
                        </div>
                    </div>
                </section>
                <section class="box">
                    <section class="block">
                        Lorem ipsum dolor sit amet, ne sed idque quidam. Vim assum corpora an Pro ut erat
                        consetetur, vocent expetendis sit at. Posse populo no usu
                        <span class="dots">...</span>
                        <span class="more">
                            Pro ut erat consetetur, vocent expetendis sit at. Posse populo no usu, nam elit
                            postea nusquam id. Ad nec unum velit, ad lorem primis officiis vis. Eam appareat
                            pericula consequuntur an, atqui saperet his eu, cum prompta fabellas interpretaris
                            et.
                        </span>
                        <button class="read is-text has-text-link p-0">
                            <span>Read More</span>
                        </button>
                    </section>
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <span class="tag is-info is-light is-medium">
                                MODIFIED
                            </span>
                        </div>
                        <div class="column">
                            <div class="tags is-multiline">
                                <span class="tag is-primary is-light is-medium">
                                    Label 1
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 2
                                </span>
                                <span class="tag is-primary is-light is-medium">
                                    Label 3
                                </span>
                            </div>
                        </div>
                        <div class="column is-narrow">
                            <button class="button is-primary">
                                <span class="icon is-small">
                                    <i class="fa fas fa-edit"></i>
                                </span>
                                <span>Modify</span>
                            </button>
                        </div>
                    </div>
                </section>
                <!-- Pagination Nav -->
                <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                    <a class="pagination-previous has-background-white">
                        <span class="icon is-small">
                            <i class="fa fas fa-chevron-left"></i>
                        </span>
                    </a>
                    <a class="pagination-next has-background-white">
                        <span class="icon is-small">
                            <i class="fa fas fa-chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pagination-list">
                        <li><a class="pagination-link has-background-white" aria-label="Goto page 1">1</a></li>
                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                        <li><a class="pagination-link has-background-white" aria-label="Goto page 45">45</a>
                        </li>
                        <li><a class="pagination-link is-current" aria-label="Page 46"
                                aria-current="page">46</a></li>
                        <li><a class="pagination-link has-background-white" aria-label="Goto page 47">47</a>
                        </li>
                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                        <li><a class="pagination-link has-background-white" aria-label="Goto page 86">86</a>
                        </li>
                    </ul>
                </nav>
            </article>
        </article>
    </article>

    <!--jQuery CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection
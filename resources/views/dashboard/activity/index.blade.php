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
                
                @foreach($counts_data as $data)
                    @if (strcmp($data->status,'alloted')!=0)
                        <div class="column is-3-desktop is-5">
                            <div class="card">
                                <div class="card-content has-text-centered">
                                    <h2 class="has-text-weight-semibold is-size-5">
                                        {{  ucwords($data->status) }} Paragraphs
                                        
                                    </h2>
                                    <h1 class="is-size-6">
                                        {{ $data->count }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @foreach($times_data as $key => $value)
                    <div class="column is-3-desktop is-5">
                        <div class="card">
                            <div class="card-content has-text-centered">
                                <h1 class="has-text-weight-semibold is-size-5">{{$key}}</h1>
                                <h1 class="is-size-6">{{$value?: 0}}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach

            </section>
            <section class="columns is-vcentered is-centered is-multiline mt-6">
                <div class="column is-5-desktop">
                    <div class="card">
                        <div class="card-image">
                            <canvas id="chart_one"></canvas>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                Line Plot for number of paragraphs labelled per day
                                for those 7 days from past in which labeling occurs.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-offset-1-desktop is-5-desktop">
                    <div class="card">
                        <div class="card-image">
                            <canvas id="chart_two"></canvas>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                Line Plot for average labeling time per day for 
                                those 7 days from past in which labeling occurs.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </article>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function makeChart(labels,data,chartName,containerId,isTime=false) {
            let ctx = document.getElementById(containerId).getContext('2d');	

            let chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: chartName,
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderColor: 'rgb(54, 162, 235)',
                        data:data,
                    }]
                },
                options: {
                    responsive: true,
                    //setting to false will prevent the height of the chart from shrinking when resizing
                    maintainAspectRatio: false,
                    scales:{
                        y:{
                            ticks: {
                                callback: function (value) {
                                    if(!isTime) return value;
                                    let min=new Date(value).getMinutes();
                                    let sec=new Date(value).getSeconds()
                                    return min+" m "+sec+" s";
                                }
                            }
                        }
                    },
                    plugins:{
                        tooltip: {
                            callbacks: {
                            label: (value) =>{
                                if(!isTime) return value.raw;
                                let min=new Date(value.raw).getMinutes();
                                let sec=new Date(value.raw).getSeconds()
                                return min+" m "+sec+" s";
                            } 
                            }
                        }
                    }
                }
            });
        }

        makeChart(
            {!! json_encode($chart_1['labels']) !!},
            {!! json_encode($chart_1['data']) !!},
            "#Paragraphs labeled/day(last 7 labeled dates)",
            'chart_one'
        );
        
        makeChart(
            {!! json_encode($chart_2['labels']) !!},
            {!! json_encode($chart_2['data']) !!}.map((time)=> new Date("0000-01-01 "+time)),
            "average labeling time/day(last 7 labeled dates)",
            'chart_two',true
        );
    </script>
@endsection
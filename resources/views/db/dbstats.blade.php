@extends('dashboard')

@section('dash-ui')
    <style> <?php include public_path('css/dbstats_css.css') ?> </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <div class="rightsec">
        <div class="toprow">

            <div class="stat">
            <div class="head"> Paragraphs Alloted</div>
            <div class="text">
                12
            </div> <!--text-->
            </div> <!--stat-->

            <div class="stat">
            <div class="head"> Paragraphs Labelled</div>
            <div class="text">
                12
            </div> <!--text-->
            </div> <!--stat-->

            <div class="stat">
            <div class="head"> Avg Time Spent</div>
            <div class="text">
                12 hrs 3 mins
            </div> <!--text-->
            </div> <!--stat-->

        </div>

        <div class="wp">
            Weekly Performance
        </div>

        <div class="graph-container">
            <div class="graph">
                <canvas id="chart_one"></canvas>
            </div>
            <div class="graph">
                <canvas id="chart_two"></canvas> 		
            </div>        	
        </div>
    </div>

    <script type="text/javascript">
        

    var ctx = document.getElementById('chart_one').getContext('2d');	

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',// The data for our dataset
        data: {
            //Insert the divisions for the x-axis here
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Temperature Data",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                //Insert data points here (y-axis)
                data: [40, 10, 5, 30, 20, 30, 50],
            }]
        },// Configuration options go here
        options: {
        //causes chart to resize when its container resizes
        responsive: true,
        //setting to false will prevent the height of the chart from shrinking when resizing
        maintainAspectRatio: false
        }
    });

    var ctx2 = document.getElementById('chart_two').getContext('2d');	

    var chart2 = new Chart(ctx2, {
        // The type of chart we want to create
        type: 'line',// The data for our dataset
        data: {
            //Insert the divisions for the x-axis here
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Temperature Data",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                //Insert data points here (y-axis)
                data: [70, 100, 5, 30, 20, 30, 50],
            }]
        },// Configuration options go here
        options: {
        //causes chart to resize when its container resizes
        responsive: true,
        //setting to false will prevent the height of the chart from shrinking when resizing
        maintainAspectRatio: false
        }
    });

    </script>
@endsection


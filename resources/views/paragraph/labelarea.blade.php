@extends('layout')

@section('content')

    <style> <?php include public_path('css/paragraphs_css.css') ?> </style>
    
    <div class="maincontainer">
        <div class="subheader">
            <div class="details">Details</div>
            <div class="fontsize">Font Size
                <input type="range" min="1" max="40" id="font-size-slider"/>
            </div>
            <div class="timerem"> <span class="clock">🕒</span>Time Remaining: &nbsp;<p id="clock"></p></div>
        </div>

        <div class="container">

            <div class="para" id="content">
                <h2>Document Details</h2>
                <p> <b>Document Number : </b> {{ $message['document']->doc_id }}</p>

                <p> <b>Case Number : </b> {{ $message['document']->case_number }}</p>
                
                <p> <b>Title : </b> {{ $message['document']->title }}</p>
                
                <p> <b>Date : </b> {{ $message['document']->date }}</p>
                <a href={{ $message['document']->document_link }} ><i>Document Link</i></a>
                {{-- <pre> --}}
                    {{-- {{ $message['document'] }} --}}
                {{-- </pre>  --}}
                <h2>Paragraph Details</h2>

                <p> 
                    <b>Page Number : </b> {{ $message['paragraph']->page }}  &nbsp;&nbsp;&nbsp;&nbsp;
                     <b>Paragraph Number : </b> {{ $message['paragraph']->paragraph_num }} 
                </p>
                <p> <b>Content : </b> {{ $message['paragraph']->content }}</p>
                {{-- <pre>{{$message['paragraph']}}</pre> --}}
            </div>

            <div class="labelcontainer">

                <form action="/paragraph/label" method="POST">
                    @csrf
    
                    @foreach ($labels->chunk(3) as $chunk)
                        <div class="labels">
                            @foreach ($chunk as $label)
                                <label class="container"> {{$label->label_name}}
                                    <input type="checkbox" name="labels[]" value="{{$label->label_num}}">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    @endforeach
        
                    <br>
                    
                    @error('labels')
                        <span class="error">{{ $message }}</span>
                    @enderror
        
                    <br>
                    
                    <div class="subfooter">
                        <button type="submit" class="submit-btn-h">
                            SUBMIT
                        </button>
                    </div>
                    <!--subfooter-->
                </form>
            </div>
            <!--labelcontainer-->
        </div>
        <!--container-->
    </div>
    <!--mainconatiner-->
    
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
            document.getElementById("content").style.fontSize = event.target.value+"px";
        });

    </script>
    
@endsection
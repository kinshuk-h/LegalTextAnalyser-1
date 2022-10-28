@extends('layout')

@section('content')
    <div style="text-align: center;margin: 250px auto;">
        {{-- style according to object handling errors also --}}

        <h1>Label Area</h1>
        <p>Paragraph</p>
        <p>{{ $message }}</p> 
        
        <form action="/paragraph/label" method="POST">
            @csrf

            @foreach ($labels as $label)
                <label class="container"> {{$label->label_name}}
                    <input type="checkbox" name="labels[]" value="{{$label->label_num}}">
                    <span class="checkmark"></span>
                </label>
            @endforeach

            <br>
            <button type="submit" style="border:3px solid;padding:2px;border-radius:5px;">
                Label
            </button>
        </form>

    </div>
    
@endsection
@extends('layout')

@section('content')
    <div style="text-align: center;margin: 250px auto;">
        {{-- <h3>{{$message ?? 'Hi,'}}</h3> --}}
        @if ($message = Session::get('message'))
        {{-- <div class="alert alert-success alert-block"> --}}
            {{-- <button type="button" class="close" data-dismiss="alert">×</button>	 --}}
                <strong style="color: green">{{ $message }}</strong>
        {{-- </div> --}}
        @endif

        <h1>Paragraph labeler</h1>
        <button style="padding: 0.8rem 1.5rem;margin: 0.8rem;border-radius: 10px;background-color: black;color: white;border: none;font-weight: bold;">
            <a href="/paragraph/allocate" >Allocate</a>
        </button>
    </div>
    
@endsection
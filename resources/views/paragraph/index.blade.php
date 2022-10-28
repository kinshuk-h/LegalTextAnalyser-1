@extends('layout')

@section('content')
    <div style="text-align: center;margin: 250px auto;">
        {{-- <h3>{{$message ?? 'Hi,'}}</h3> --}}
        <h1>Paragraph labeler</h1>
        <button><a href="/paragraph/allocate" >Allocate</a></button>
    </div>
    
@endsection
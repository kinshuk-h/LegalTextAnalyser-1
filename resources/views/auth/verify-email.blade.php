@extends('layout')

@section('content')
    <div style="margin: 100px auto;text-align:center">
        <form style="border: 2px solid green;display:inline;padding:10px;background-color:lightgreen;border-radius: 15px;" 
            method="POST" action="{{ route('verification.send') }}">
            @csrf
            
            <p style="display:inline;">Please verify your email with link sent to your email.
            Didn't Received ?
            <button style="all:unset;display:inline;color:blue;border-radius: 5px;text-decoration: underline;cursor:pointer" 
                type="submit">Resend Link</button></p>
        </form>
    </div>
@endsection
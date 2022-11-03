@extends('dashboard')

@section('dash-ui')
    <style> <?php include public_path('css/dbtasks_css.css') ?> </style>

    <div class="rightsec">
        <div class="mytasks">
            My Tasks
        </div>
    
        <div class="card">
            <div class="context">
                <div class="para">dfghfffffffffffffffffffffffffffffffffffffff</div>
                <div class="labels">labels</div>
            </div>
        <button class="modify-btn">MODIFY</button>
        </div>
        <div class="card">
            <div class="context">
                <div class="para">dfghfffffffffffffffffffffffffffffffffffffff</div>
                <div class="labels">labels</div>
            </div>
        <button class="modify-btn">MODIFY</button>
        </div>
        <div class="card">
            <div class="context">
                <div class="para">dfghfffffffffffffffffffffffffffffffffffffff</div>
                <div class="labels">labels</div>
            </div>
        <button class="modify-btn">MODIFY</button>
        </div>
        <div class="card">
            <div class="context">
                <div class="para">dfghfffffffffffffffffffffffffffffffffffffff</div>
                <div class="labels">labels</div>
            </div>
        <button class="modify-btn">MODIFY</button>
        </div>
    
        <div class="buttons">
        <button class="btn">PREVIOUS</button>
        <button class="btn">NEXT</button>
        </div>
    </div>
@endsection
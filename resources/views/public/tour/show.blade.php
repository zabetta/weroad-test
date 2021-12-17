@extends('layouts.public')

@section('content')

<h2>Travel Details</h2>

    <div class="row">
        <div class="col-md-12">
            <label for="name">name:</label><br>
                {{$travel->name}}
        </div>
        <div class="col-md-12">
            <label for="description">description:</label><br>
                {{$travel->description}}
        </div>
        <div class="col-md-12">
            <label for="duration">duration:</label><br>
                {{$travel->number_of_days}} Days ({{$travel->number_of_days - 1}} night)
        </div>
        <div class="col-md-2">
            <label for="moods-nature">nature:</label><br>
                {{$travel->moods->nature}}%
        </div>
        <div class="col-md-2">
            <label for="moods-culture">culture:</label><br>
                {{$travel->moods->culture}}%
        </div>
        <div class="col-md-2">
            <label for="moods-relax">relax:</label><br>
                {{$travel->moods->relax}}%
        </div>
        <div class="col-md-2">
            <label for="moods-history">history:</label><br>
                {{$travel->moods->history}}%
        </div>
        <div class="col-md-2">
            <label for="moods-party">party:</label><br>
                {{$travel->moods->party}}%
        </div>
    </div>   
<h2>Tour Details</h2>
<div class="row">
        <div class="col-md-12">
            <label for="name">name:</label><br>
                {{$tour->name}}
        </div>
        <div class="col-md-12">
            <label for="starting_date">starting_date:</label><br>
                 {{ \Carbon\Carbon::parse($tour->starting_date)->format('d m Y')}}
        </div>
        <div class="col-md-12">
            <label for="ending_date">ending_date:</label><br>
                 {{ \Carbon\Carbon::parse($tour->ending_date)->format('d m Y')}}
        </div>
    </div>   
@stop
@extends('layouts.public')

@section('content')

    @if(isset($messageOk))
        <div class="alert alert-success" role="alert">
            {{$messageOk}}
        </div>
    @endif
    @if(isset($messageKo))
        <div class="alert alert-danger" role="alert">
            {{$messageKo}}
        </div>
    @endif

    <div class="row">
        <div class="h1">Edit Travel</div>
    </div>
    <form action="{{route('travels.update')}}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="id" value="{{$travel->id}}" placeholder="Enter travel slug">
        <div class="form-group mx-sm-3">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{$travel->slug}}" placeholder="Enter travel slug">
            
        </div>
        <div class="form-group mx-sm-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$travel->name}}" placeholder="Enter travel name">
        </div>
        <div class="form-group mx-sm-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter travel description" >{{$travel->description}}</textarea>
        </div>
        <div class="form-group mx-sm-3">
            <label for="numberOfDays">number of days</label>
            <input type="number" class="form-control" id="numberOfDays" name="numberOfDays" value="{{$travel->numberOfDays}}" placeholder="Enter travel numberOfDays">
        </div>
        <div class="form-group mx-sm-3">
            <label for="Nature">Nature Mood</label>
            <input type="number" max="100" class="form-control" id="nature" name="nature" value="{{$travel->moods->nature}}" placeholder="Enter mood Nature percentage">
        </div>
        <div class="form-group mx-sm-3">
            <label for="Relax">Relax Mood</label>
            <input type="number" max="100" class="form-control" id="relax" name="relax" value="{{$travel->moods->relax}}" placeholder="Enter mood Relax percentage">
        </div>
        <div class="form-group mx-sm-3">
            <label for="History">History Mood</label>
            <input type="number" max="100" class="form-control" id="history" name="history" value="{{$travel->moods->history}}" placeholder="Enter mood History percentage">
        </div>
        <div class="form-group mx-sm-3">
            <label for="Culture">Culture Mood</label>
            <input type="number" max="100" class="form-control" id="culture" name="culture" value="{{$travel->moods->culture}}" placeholder="Enter mood Culture percentage">
        </div>
        <div class="form-group mx-sm-3">
            <label for="Party">Party Mood</label>
            <input type="number" max="100" class="form-control" id="party" name="party" value="{{$travel->moods->party}}" placeholder="Enter mood Party percentage">
        </div>
        <div class="form-group mx-sm-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
    

@stop

@section('script')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                dateFormat: 'yy-m-d'
            });
        } );
    </script>
@stop
@extends('layouts.public')

@section('content')
    <div class="row">
        <div class="h1">Create New Tour </div>
    </div>

    <!-- 
        'travel_id',
        'name',
        'starting_date',
        'ending_date',
        'price'
    -->

    <form action="{{route('tours.store')}}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group mx-sm-3">
            <label for="slug">Travels</label>
            <select class="form-control" id="travelId" name="travelId">
                <option value="">Select one travel</option>
                @foreach($travels as $travel)
                <option value="{{$travel->id}}">{{$travel->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mx-sm-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter travel name">
        </div>
        <div class="form-group mx-sm-3">
            <label for="startingDate">Starting Date <br/>
                <input type="text"  id="startingDate" name="startingDate" class="form-control datepicker">
            </label>
        </div>
        <div class="form-group mx-sm-3">
            <label for="endingDate">Ending Date <br/>
                <input type="text"  id="endingDate" name="endingDate" class="form-control datepicker">
            </label>
        </div>
        <div class="form-group mx-sm-3">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Enter tour price" />
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
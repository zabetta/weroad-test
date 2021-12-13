@extends('layouts.public')

@section('content')
    <div class="row">
        <div class="h2">{{$travel->name}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{$travel->description}}
        </div>
    </div>
    <hr>
    <p><b>Tours</b></p>
    <form action="" method="post">
        @csrf
        <input type="hidden" name="travelId" value="{{$travel->id}}">
        <label for="priceFrom">Price from <br/>
            <select name="priceFrom" id="priceFrom">
                <option value="">Select price from</option>
                <option value="100">@convert(100)</option>
                <option value="50000">@convert(50000)</option>
                <option value="100000">@convert(100000)</option>
                <option value="200000">@convert(200000)</option>
                <option value="500000">@convert(500000)</option>
            </select>
        </label>
        <label for="priceTo">Price to <br/>
            <select name="priceTo" id="priceTo">
                <option value="">Select price to</option>
                <option value="100">@convert(100)</option>
                <option value="50000">@convert(50000)</option>
                <option value="100000">@convert(100000)</option>
                <option value="200000">@convert(200000)</option>
                <option value="500000">@convert(500000)</option>
            </select>
        </label>
        <label for="startingDate">Starting Date <br/>
            <input type="text"  id="startingDate" name="startingDate" class="datepicker">
        </label>
        <label for="endingDate">Ending Date <br/>
            <input type="text"  id="endingDate" name="endingDate" class="datepicker">
        </label>
        <label for="sortingPrice">Sort by price <br/>
            <select name="sortingPrice" id="sortingPrice">
                <option value="">Sort method</option>
                <option value="asc">asc</option>
                <option value="desc">desc</option>
            </select>
        </label>
        <input type="submit" value="filter">
    </form>

    @foreach ($tours as $tour)
        <div class="row">
            <div class="col-md-1"> - </div>
            <div class="col-md-3">
                {{ \Carbon\Carbon::parse($tour->starting_date)->format('d m Y')}}
            </div>
            <div class="col-md-4">
                {{ \Carbon\Carbon::parse($tour->ending_date)->format('d m Y')}}
            </div>
            <div class="col-md-4">
                @convert($tour->price)
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            {{$tours->render()}}
        </div>
    </div>

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
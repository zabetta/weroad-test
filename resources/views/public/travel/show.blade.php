@extends('layouts.public')

@section('content')
    <div class="row">
        <div class="h2">{{$travel->name}}</div>
        @if (Auth::check())
            <a href="{{route('travels.edit',$travel->id)}}">
                <button>
                    edit
                </button>
            </a>  
            @isRole('admin')
                <a href="{{route('tours.create',$travel->id)}}">
                    <button>
                        Create Tour
                    </button>
                </a>
            @endisRole
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            {{$travel->description}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            Duration : {{$travel->number_of_days}} Days ( {{$travel->number_of_days - 1}} Nights )
        </div>
    </div>
    <hr>
    <p><b>Moods</b></p>
    Nature
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$travel->moods->nature}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
    </div>    
    Relax
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$travel->moods->relax}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
    </div>    
    History
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$travel->moods->history}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
    </div>    
    Culture
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$travel->moods->culture}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
    </div>    
    Party
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$travel->moods->party}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <p><b>Tours</b></p>
    <form action="{{route('travels.filter')}}" method="post" autocomplete="off">
        @csrf
        <input type="hidden" name="travelId" value="{{$travel->id}}">
        <label for="priceFrom">Price from <br/>
            <select name="priceFrom" id="priceFrom">
                <option value="">Select price from</option>
                <option value="100" @if(old('priceFrom') == 100) selected @endif>@convert(100)</option>
                <option value="50000" @if(old('priceFrom') == 50000) selected @endif>@convert(50000)</option>
                <option value="100000" @if(old('priceFrom') == 100000) selected @endif>@convert(100000)</option>
                <option value="200000" @if(old('priceFrom') == 200000) selected @endif>@convert(200000)</option>
                <option value="500000" @if(old('priceFrom') == 500000) selected @endif>@convert(500000)</option>
            </select>
        </label>
        <label for="priceTo">Price to <br/>
            <select name="priceTo" id="priceTo">
                <option value="">Select price to</option>
                <option value="100" @if(old('priceTo') == 100) selected @endif >@convert(100)</option>
                <option value="50000" @if(old('priceTo') == 50000) selected @endif >@convert(50000)</option>
                <option value="100000" @if(old('priceTo') == 100000) selected @endif >@convert(100000)</option>
                <option value="200000" @if(old('priceTo') == 200000) selected @endif >@convert(200000)</option>
                <option value="500000" @if(old('priceTo') == 500000) selected @endif >@convert(500000)</option>
            </select>
        </label>
        <label for="startingDate">Starting Date <br/>
            <input type="text"  id="startingDate" name="startingDate" class="datepicker" value={{@old('startingDate')}}>
        </label>
        <label for="endingDate">Ending Date <br/>
            <input type="text"  id="endingDate" name="endingDate" class="datepicker" value={{@old('endingDate')}}>
        </label>
        <label for="sortingPrice">Sort by price <br/>
            <select name="sortingPrice" id="sortingPrice">
                <option value="">Sort method</option>
                <option value="asc" @if(old('sortingPrice') == 'asc') selected @endif >asc</option>
                <option value="desc" @if(old('sortingPrice') == 'desc') selected @endif>desc</option>
            </select>
        </label>
        <input type="submit" value="filter">
    </form>

    @foreach ($tours as $tour)
        <div class="row">
            <div class="col-md-1"> <a href="{{route('tours.show',$tour->id )}}"><button>show</button></a> </div>
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
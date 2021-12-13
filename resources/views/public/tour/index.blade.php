@extends('layouts.public')

@section('content')

<div class="row">
    @foreach ($tours as $tour)
        <div class="col-md-12">
            <a href="{{route('tours.details',$tour->slug)}}">{{$tour->name}}</a>
        </div>
    @endforeach

    <div class="col-md-12">
        {{$tours->render()}}
    </div>
</div>

@stop
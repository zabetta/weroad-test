@extends('layouts.public')

@section('content')

<div class="row">
    @foreach ($travels as $travel)
        <div class="col-md-12">
            <a href="{{route('travels.details',$travel->slug)}}">{{$travel->name}}</a>
        </div>
    @endforeach

    <div class="col-md-12">
        {{$travels->render()}}
    </div>
</div>

@stop
@extends('layouts.public')

@section('content')

<div class="row">
    @foreach ($travels as $travel)
        <div class="col-md-12"style="margin-top:5px">
            <strong>{{$travel->name}}</strong><br>
            <a href="{{route('travels.show',$travel->id)}}">
                    <button>
                        show
                    </button>
                </a>
            @if (Auth::check())
                <a href="{{route('travels.edit',$travel->id)}}">
                    <button>
                        edit
                    </button>
                </a>  
            @endif
        </div>
    @endforeach

    <div class="col-md-12" style="margin-top:50px">
        {{$travels->render()}}
    </div>
</div>

@stop
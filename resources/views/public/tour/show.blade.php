@extends('layouts.public')

@section('content')

Travel Details
    <pre>
    id: {{$tour->id}}
    travel_id: {{$tour->travel_id}}
    name: {{$tour->name}}
    starting_date: {{$tour->starting_date}}
    </pre>
@stop
@extends('app')
@section('title', 'Building')
@section('content')
    <h2>{{ $building->building_name }}</h2>
    <h3>{{ $building->street . ', ' . $building->postal }}</h3>
@stop
@extends('app')
@section('title', 'Building')
@section('content')


    <h2>{{ $building->building_name }}</h2>
    <h3>{{ $building->street . ', ' . $building->postal }}</h3>

    <form action="foobar" method="post" class="dropzone">
        {{ csrf_field() }}
        <div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->

        <!-- Now setup your input fields -->
        <input type="email" name="username" />
        <input type="password" name="password" />

        <button type="submit">Submit data and files!</button>
    </form>

@stop

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>

@stop
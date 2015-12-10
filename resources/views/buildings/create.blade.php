@extends('app')
@section('title', 'Add New Building')
@section('content')
    <h1>Add New Building</h1>
    <div class="row">
        <form method="post" action="/buildings" enctype="multipart/form-data" class="col-md-6">
            @include('buildings.form')

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>
    </div>
@stop

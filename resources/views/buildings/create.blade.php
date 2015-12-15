@extends('app')
@section('title', 'Add New Building')
@section('content')
    <h1>Add New Building</h1>
    @can('create_building')
        <div class="row">
            {{--<form method="post" action="/buildings" enctype="multipart/form-data" class="col-md-6">--}}
                {!! Form::open(
                    array(
                        'route' => 'buildings.store',
                        'class' => 'form',
                        'files' => true)) !!}
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
    @else
        <p>You cannot add a building.</p>
    @endcan
@stop

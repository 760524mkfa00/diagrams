@extends('app')
@section('title', 'Add New Building')
@section('content')
    <h1>Update Building</h1>
    @can('create_building')
        <div class="row">
            {{--<form method="post" action="/buildings" enctype="multipart/form-data" class="col-md-6">--}}
            {!! Form::model($data,
                    array('route' => ['buildings.update',$data->id], 'method' => 'PATCH', 'role' => 'form')) !!}
                <input name="update" type="hidden" value="TRUE">
                @include('buildings.form', ['submitButtonText' => 'Update Building'])


                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            {!! Form::close() !!}
        </div>
    @else
        <p>You cannot add a building.</p>
    @endcan
@stop

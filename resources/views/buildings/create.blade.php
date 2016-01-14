@extends('app')
@section('title', 'Add New Building')
@section('content')
    <h1>Add New Building</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Add Building<i class="small"> (all fields required)</i>
                    </h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content form-horizontal row-border">
                    <div class="row">
                        @can('create_building')
                            {!! Form::open(
                                array(
                                    'route' => 'buildings.store',
                                    'class' => 'form',
                                    'files' => true)) !!}
                            @include('buildings.form', ['submitButtonText' => 'Create Building'])

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!! Form::Close() !!}
                        @else
                            <p>You cannot add a building.</p>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

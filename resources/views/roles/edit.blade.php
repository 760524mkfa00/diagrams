@extends('../app')
@section('content')

    <h1>{{ $roles->label }}</h1>
    {!! Form::open( array('route' => array('roles.sync', $roles->id ), 'method' => 'post')) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Update Roles
                    </h4>

                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content form-horizontal row-border">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                @include("permissions/assign")
                            </div>
                            {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Add users to Role
                    </h4>

                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content form-horizontal row-border">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                @include("user/assign")
                            </div>
                            {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
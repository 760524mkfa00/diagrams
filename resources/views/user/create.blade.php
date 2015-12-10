@extends('../app')
@section('title', 'Create User')
@section('content')
    <h1>Create New User</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Add User
                    </h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content form-horizontal row-border">
                    <div class="row">
                        {!! Form::open( array('route' => 'users.store','role' => 'form')) !!}
                        <input name="update" type="hidden" value="">
                        @include('user._partials.form', ['submitButtonText' => 'Add User', 'passwordPlaceHolder' => 'Passwords must match'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
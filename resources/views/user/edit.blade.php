@extends('../app')
@section('title', $data->first_name . ' ' .  $data->last_name)
@section('content')

    <h1>{{ $data->first_name . ' ' .  $data->last_name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Edit User
                    </h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content form-horizontal row-border">
                    <div class="row">
                        <div class="col-md-9">
                            {{-- TODO: lock username, first/last name and route --}}
                            {!! Form::model($data, array('route' => ['users.update', $data->id], 'method' => 'PATCH', 'role' => 'form')) !!}
                                 <input name="update" type="hidden" value="TRUE">
                                @include('user._partials.form', ['submitButtonText' => 'Update User', 'passwordPlaceHolder' => 'Leave empty for no password change'])
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-3">
                            {!! HTML::image('img/avatar-large.jpg', 'User Image') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
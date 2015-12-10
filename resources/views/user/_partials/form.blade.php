<div class="">
    <ul class="list-group col-md-6">
        <li class="list-group-item {!! $errors->has('email') ? 'has-error' : '' !!}">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', NULL, array('class' => 'form-control')) !!}
            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
        </li>
        <li class="list-group-item {!! $errors->has('first_name') ? 'has-error' : '' !!}">
            {!! Form::label('first_name', 'Firstname:') !!}
            {!! Form::text('first_name', NULL, array('class' => 'form-control')) !!}
            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
        </li>
        <li class="list-group-item {!! $errors->has('last_name') ? 'has-error' : '' !!}">
            {!! Form::label('last_name', 'Lastname:') !!}
            {!! Form::text('last_name', NULL, array('class' => 'form-control')) !!}
            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
        </li>

        <li class="list-group-item {!! $errors->has('password') ? 'has-error' : '' !!}">
            <p><strong>{!! $passwordPlaceHolder !!}</strong></p>
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', array('class' => 'form-control')) !!}
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </li>
        <li class="list-group-item {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
            {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
        </li>
    </ul>
    <ul class="list-group col-md-6">
        <li class="list-group-item">
            {!! Form::label('city', 'City:') !!}
            {!! Form::text('city', NULL, array('class' => 'form-control')) !!}
        </li>
        <li class="list-group-item">
            {!! Form::label('phone', 'Phone:') !!}
            {!! Form::text('phone', NULL, array('class' => 'form-control')) !!}
        </li>
        <li class="list-group-item">
            {!! Form::label('cell', 'Cell:') !!}
            {!! Form::text('cell', NULL, array('class' => 'form-control')) !!}
        </li>

    </ul>
    <div class="col-md-12">
        <hr>
        <div class="form-group">
            <a type="button" class="btn btn-default" href="{!! URL::route('users.index') !!}">Back</a>
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>
</div>
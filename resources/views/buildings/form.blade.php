@inject('countries', 'Plans\Http\Utilities\Country')

{{--{{ csrf_field() }}--}}

<div class="form-group">
    {!! Form::label('building_name', 'Building Name:') !!}
    {!! Form::text('building_name', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<div class="form-group">
    {!! Form::label('street', 'Street:') !!}
    {!! Form::text('street', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<div class="form-group">
    {!! Form::label('town', 'Town:') !!}
    {!! Form::text('town', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<div class="form-group">
    {!! Form::label('postal', 'Zip/Postal Code:') !!}
    {!! Form::text('postal', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<div class="form-group">
    {!! Form::label('province', 'Province:') !!}
    {!! Form::text('province', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<div class="form-group">
    <label for="country">Country:</label>
    <select id="country" name="country" class="form-control" required>
        @foreach($countries::all() as $country => $code)
            <option value="{{ $code }}">{{ $country }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::label('telephone', 'Telephone:') !!}
    {!! Form::text('telephone', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<div class="form-group">
    {!! Form::label('building_type', 'Building Type:') !!}
    {!! Form::text('building_type', NULL, array('class' => 'form-control', 'required')) !!}
</div>
<hr>
<div class="form-group">
    {!! Form::label('description', 'Building Description:') !!}
    {!! Form::textarea('description', NULL, array('class' => 'form-control', 'required')) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
</div>
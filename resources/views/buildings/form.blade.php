@inject('countries', 'Plans\Http\Utilities\Country')

{{ csrf_field() }}

<div class="form-group">
    <label for="building_name">Name:</label>
    <input type="text" name="building_name" id="building_name" class="form-control" value="{{ old('building_name') }}" required>
</div>
<div class="form-group">
    <label for="street">Street:</label>
    <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required>
</div>
<div class="form-group">
    <label for="town">Town:</label>
    <input type="text" name="town" id="town" class="form-control" value="{{ old('town') }}" required>
</div>
<div class="form-group">
    <label for="postal">Zip/Postal Code</label>
    <input type="text" name="postal" id="postal" class="form-control" value="{{ old('postal') }}" required>
</div>
<div class="form-group">
    <label for="province">Province:</label>
    <input type="text" name="province" id="province" class="form-control" value="{{ old('province') }}" required>
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
    <label for="telephone">Telephone:</label>
    <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}" required>
</div>
<div class="form-group">
    <label for="building_type">Building Type:</label>
    <input type="text" name="building_type" id="building_type" class="form-control" value="{{ old('building_type') }}" required>
</div>
<hr>
<div class="form-group">
    <label for="description">Building Description:</label>
            <textarea type="text" name="description" id="description" class="form-control" rows="10" required>
                {{ old('description') }}
            </textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-default">Add Building</button>
</div>
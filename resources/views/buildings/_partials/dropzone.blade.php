@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@can('add_picture')
<h2>Upload Images Here</h2>

<form id="addPhotosForm" action="{{ Route('addPicture',[$building->building_name,  $building->street]) }}"
      method="post" class="dropzone" enctype="multipart/form-data">
    {{ csrf_field() }}
</form>
@endcan
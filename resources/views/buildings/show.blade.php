@extends('app')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2>{{ $building->building_name }}</h2>
            <h3>{{ $building->street . ', ' . $building->postal }}</h3>
            <hr>
            <p>{!! nl2br($building->description) !!}</p>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @foreach($building->pictures->chunk(4) as $set)
                        <div class="row">
                            @foreach($set as $picture)
                                <div class="col-md-3">
                                    <a href="{{ asset($picture->path) }}" data-lity>
                                        <img src="{{ asset($picture->thumbnail_path) }}" alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
            <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <th>Floor</th>
                        <th>File Name</th>
                        <th>File</th>
                        </thead>
                        @foreach($building->plans as $plan)
                            <tr>
                                <td>{!! Form::select('floor', $floors, $plan->id, ['disabled', 'class' => 'selectpicker form-control']) !!}</td>
                                <td>{{ $plan->name }}</td>
                                <td><a href="{{ route('get.file', [$building->building_name, $plan->path])  }}">{{ $plan->path }}</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                <form id="addPhotosForm" action="{{ Route('addPicture',[$building->building_name,  $building->street]) }}" method="post" class="dropzone">
                    {{ csrf_field() }}
                </form>
            @endcan
            @can('add_picture')
                <hr>
                <h2>Upload Files</h2>
                <p>Please ensure you name you files and select the correct floor.</p>
                <form action="{{ Route('addFile',[$building->building_name,  $building->street]) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-md-12">
                    {{ csrf_field() }}
                    <input type="hidden" name="building_name" value="{{ $building->building_name }}">
                    <div class="form-group">
                        <label for="file_name" class="control-label">File Name</label>
                        <input name="file_name" type="text" class="form-control" id="file_name" placeholder="File Name" required>
                    </div>
                    <div class="form-group">
                        <label for="floor" class="control-label">Floor</label>
                        {!! Form::select('floor', $floors, null, ['class' => 'form-control', 'id'=> 'floor', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="path" class="control-label">File input</label>
                        <input type="file" name="file" required>
                        <p class="help-block">Click and select the file to upload.</p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
            @endcan
        </div>
    </div>
@stop

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
<script>
    Dropzone.options.addPhotosForm = {
        maxFilesize: 2,
        acceptedFiles: '.jpg, .jpeg, .png, .bmp'
    };
</script>
@stop
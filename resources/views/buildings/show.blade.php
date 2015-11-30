@extends('app')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2>{{ $building->building_name }}</h2>
            <h3>{{ $building->street . ', ' . $building->postal }}</h3>
            <hr>
            <p>{{ $building->description }}</p>
            <hr>
            @foreach($building->pictures as $picture)
                <div class="col-md-3">
                    <img src="/{{ $picture->path }}" alt="">
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>Upload Images Here</h2>
            <form id="addPhotosForm" action="/buildings/{{ $building->building_name }}/{{ $building->street }}/photos" method="post" class="dropzone">
                {{ csrf_field() }}
            </form>
            <hr>
            <h2>Upload Files</h2>
            <p>Please ensure you name you files and select the correct floor.</p>
            <form action="/buildings/{{ $building->building_name }}/{{ $building->street }}/file" method="post" class="form-horizontal col-md-12">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="file_name" class="control-label">File Name</label>
                    <input name="file_name" type="text" class="form-control" id="file_name" placeholder="File Name">
                </div>
                <div class="form-group">
                    <label for="floor" class="control-label">Floor</label>
                    <input name="floor" type="text" class="form-control" id="floor" placeholder="Floor">
                </div>
                <div class="form-group">
                    <label for="path" class="control-label">File input</label>
                    <input type="file" id="exampleInputFile">
                    <p class="help-block">Click and select the file to upload.</p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
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
@extends('app')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2>{{ $building->building_name }}</h2>
            <h3>{{ $building->street . ', ' . $building->postal }}</h3>
            <hr>
            <p>{!! nl2br($building->description) !!}</p>
            <hr>
            <div class="clearfix">
                @foreach($building->pictures as $picture)
                    <div class="col-md-12">
                        <img src="/{{ $picture->thumbnail_path }}" alt="">
                    </div>
                @endforeach
            </div>
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
                            <td>{{ $plan->floor_id }}</td>
                            <td>{{ $plan->name }}</td>
                            <td><a href="{{ route('get.file', [$building->building_name, $plan->path])  }}">{{ $plan->path }}</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Upload Images Here</h2>
            <form id="addPhotosForm" action="/buildings/{{ $building->building_name }}/{{ $building->street }}/photos" method="post" class="dropzone">
                {{ csrf_field() }}
            </form>
            <hr>
            <h2>Upload Files</h2>
            <p>Please ensure you name you files and select the correct floor.</p>
            <form action="/buildings/{{ $building->building_name }}/{{ $building->street }}/file" method="post" enctype="multipart/form-data" class="form-horizontal col-md-12">
                {{ csrf_field() }}
                <input type="hidden" name="building_name" value="{{ $building->building_name }}">
                <div class="form-group">
                    <label for="file_name" class="control-label">File Name</label>
                    <input name="file_name" type="text" class="form-control" id="file_name" placeholder="File Name" required>
                </div>
                <div class="form-group">
                    <label for="floor" class="control-label">Floor</label>
                    <input name="floor" type="text" class="form-control" id="floor" placeholder="Floor" required>
                    {!! Form::select('floor', $floors) !!}
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
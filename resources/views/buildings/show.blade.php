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
                                    @can('delete_picture')
                                    <form method="POST" action="{{ Route('removePicture',[$picture->id]) }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit">Delete</button>
                                    </form>
                                    @endcan
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
                        <th></th>
                        </thead>
                        @foreach($building->plans as $plan)
                            <tr>
                                <td>{!! Form::select('floor', $floors, $plan->floor_id, ['disabled', 'class' => 'selectpicker form-control']) !!}</td>
                                <td>{{ $plan->name }}</td>
                                <td><a href="{{ route('get.file', [$plan->id])  }}">Download File</a>
                                @can('delete_file')
                                <td>
                                    <form method="POST" action="{{ Route('removeFile',[$plan->id]) }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                                @endcan
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

            <form id="addPhotosForm" action="{{ Route('addPicture',[$building->building_name,  $building->street]) }}"
                  method="post" class="dropzone" enctype="multipart/form-data">
                {{ csrf_field() }}
            </form>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @can('add_picture')
            <hr>
            <h2>Upload Files</h2>

            <p>Please ensure you name you files and select the correct floor.</p>
            <form action="{{ Route('addFile',[$building->building_name,  $building->street]) }}" method="post"
                  enctype="multipart/form-data" class="form-horizontal col-md-12">
                {{ csrf_field() }}
            <div id="actions" class="row">
                <div class="col-lg-12">
                        <span class="btn btn-success fileinput-button dz-clickable">
                        <i class="fa fa-plus"></i>
                        <span>Add files...</span>
                        </span>
                    <button class="btn btn-primary start" type="submit">
                        <i class="fa fa-upload"></i>
                        <span>Start upload</span>
                    </button>
                    <button class="btn btn-warning cancel" type="reset">
                        <i class="fa fa-ban"></i>
                        <span>Cancel upload</span>
                    </button>
                </div>
                <div class="col-lg-5">
                    <span class="fileupload-process">
                        <div id="total-progress" class="progress progress-striped active" aria-valuenow="0" aria-valuemax="100" aria-valuemin="0" role="progressbar" style="opacity: 0;">
                            <div class="progress-bar progress-bar-success" data-dz-uploadprogress="" style="width:0%;"></div>
                        </div>
                    </span>
                </div>
            </div>




                <div>
                    <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
                    <div class="table table-striped" class="files" id="previews">

                        <div id="template" class="file-row row">
                            <hr>

                            <!-- This is used as the file preview template -->
                            <div>
                                <span class="preview"><img data-dz-thumbnail/></span>
                            </div>
                            <div class="col-md-3">
                                <p class="name" data-dz-name></p>
                                {{ csrf_field() }}
                                <strong class="error text-danger" data-dz-errormessage></strong>
                                <input name="file_name" type="text" class="form-control" id="file_name" placeholder="File Name" data-dz-file-name required>
                                {!! Form::select('floor', $floors, null, ['class' => 'form-control', 'id'=> 'floor', 'required', 'data-dz-floor']) !!}
                            </div>
                            <div class="col-md-6">
                                <p class="size" data-dz-size></p>

                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"
                                         data-dz-uploadprogress></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary start">
                                    <i class="fa fa-upload"></i>
                                    <span>Start</span>
                                </button>
                                <button data-dz-remove class="btn btn-warning cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel</span>
                                </button>
                                <button data-dz-remove class="btn btn-danger delete">
                                    <i class="fa fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                {{--<input type="hidden" name="building_name" value="{{ $building->building_name }}">--}}
                {{--<div class="form-group">--}}
                {{--<label for="file_name" class="control-label">File Name</label>--}}
                {{--<input name="file_name" type="text" class="form-control" id="file_name" placeholder="File Name" required>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<label for="floor" class="control-label">Floor</label>--}}
                {{--{!! Form::select('floor', $floors, null, ['class' => 'form-control', 'id'=> 'floor', 'required']) !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<label for="path" class="control-label">File input</label>--}}
                {{--<input type="file" name="file" required>--}}
                {{--<p class="help-block">Click and select the file to upload.</p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
                {{--</div>--}}
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


                // This is the files section

                // Get the template HTML and remove it from the doumenthe template HTML and remove it from the document
                var previewNode = document.querySelector("#template");
                previewNode.id = "";
                var previewTemplate = previewNode.parentNode.innerHTML;
                previewNode.parentNode.removeChild(previewNode);

                var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                    url: "{{ Route('addFile',[$building->building_name,  $building->street]) }}", // Set the url
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    paramName: "file",
                    thumbnailWidth: 80,
                    thumbnailHeight: 80,
                    parallelUploads: 20,
                    previewTemplate: previewTemplate,
                    autoQueue: false, // Make sure the files aren't queued until manually added
                    previewsContainer: "#previews", // Define the container to display the previews
                    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
                });

                myDropzone.on("addedfile", function (file) {
                    // Hookup the start button
                    file.previewElement.querySelector(".start").onclick = function () {
                        myDropzone.enqueueFile(file);
                    };
                });

                // Update the total progress bar
                myDropzone.on("totaluploadprogress", function (progress) {
                    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
                });

                myDropzone.on("sending", function (file) {
                    // Show the total progress bar when upload starts
                    document.querySelector("#total-progress").style.opacity = "1";
                    // And disable the start button
                    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                });

                // Hide the total progress bar when nothing's uploading anymore
                myDropzone.on("queuecomplete", function (progress) {
                    document.querySelector("#total-progress").style.opacity = "0";
                });

                // Setup the buttons for all transfers
                // The "add files" button doesn't need to be setup because the config
                // `clickable` has already been specified.
                document.querySelector("#actions .start").onclick = function () {
                    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
                };
                document.querySelector("#actions .cancel").onclick = function () {
                    myDropzone.removeAllFiles(true);
                };
            </script>
@stop
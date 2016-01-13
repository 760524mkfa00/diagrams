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
                        <th>File Type</th>
                        <th>File</th>
                        <th></th>
                        </thead>
                        @foreach($building->plans as $plan)
                            <tr>
                                <td>{!! Form::select('floor', $floors, $plan->floor_id, ['disabled', 'class' => 'selectpicker form-control']) !!}</td>
                                <td>{{ $plan->name }}</td>
                                @if($plan->file_type <> "pdf")
                                    <td style="color:blue"><i class="fa fa-pencil-square-o"></i> {{$plan->file_type}}</td>
                                @else
                                    <td style="color:red"><i class="fa fa-file-{{$plan->file_type}}-o"></i> {{$plan->file_type}}</td>
                                @endif
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


                <form id="fileupload" action="{{ Route('addFile',[$building->building_name,  $building->street]) }}"
                      method="post" enctype="multipart/form-data" >
                    <noscript><input type="hidden" name="redirect" value="//plans.dev/"></noscript>
                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span>Add files...</span>
                        <input type="file" name="files[]" multiple>
                    </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="fa fa-upload"></i>
                                <span>Start upload</span>
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="fa fa-ban"></i>
                                <span>Cancel upload</span>
                            </button>
                            {{--<button type="button" class="btn btn-danger delete">--}}
                                {{--<i class="fa fa-trash"></i>--}}
                                {{--<span>Delete</span>--}}
                            {{--</button>--}}
                            {{--<input type="checkbox" class="toggle">--}}
                            <!-- The global file processing state -->

                            <span class="fileupload-process"></span>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped">
                        <thead>
                            <th></th>
                            <th>File</th>
                            <th>File Name<br/><i span="small">(file extensions will be removed)</i></th>
                            <th>Floor/Location</th>
                            <th>Processing<br/><i span="small">(10MB Maximum file size)</i></th>
                            <th>Actions</th>
                        </thead>
                        <tbody class="files"></tbody></table>

                </form>
            @endcan
        </div>
    </div>
@stop

@section('footer')

        <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">.
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="chunk" name="chunk" value="false">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td><input id="file_name" name="file_name" type="text" class="fileInput form-control" placeholder="File Name" value="{%=file.name%}" required></td>
        <td>{!! Form::select('floor', $floors, null, ['class' => 'form-control', 'id' => 'floor','required']) !!}</td>
        <td>{!! Form::select('type', $floors, null, ['class' => 'form-control', 'id' => 'type','required']) !!}</td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">

</script>

    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    {!! HTML::script('uploader/js/vendor/jquery.ui.widget.js') !!}
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    {{--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    {!! HTML::script('uploader/js/jquery.iframe-transport.js') !!}
    <!-- The basic File Upload plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload.js') !!}
    <!-- The File Upload processing plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload-process.js') !!}
    <!-- The File Upload image preview & resize plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload-image.js') !!}
    <!-- The File Upload audio preview plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload-audio.js') !!}
    <!-- The File Upload video preview plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload-video.js') !!}
    <!-- The File Upload validation plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload-validate.js') !!}
    <!-- The File Upload user interface plugin -->
    {!! HTML::script('uploader/js/jquery.fileupload-ui.js') !!}
    <!-- The main application script -->
    {!! HTML::script('uploader/js/main.js') !!}
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    {!! HTML::script('uploader/js/cors/jquery.xdr-transport.js') !!}
    <![endif]-->

    <script>
        /*jslint unparam: true, regexp: true */
        /*global window, $ */
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = "{{ Route('addFile',[$building->building_name,  $building->street]) }}",
                    uploadButton = $('<button/>')
                            .addClass('btn btn-primary')
                            .prop('disabled', true)
                            .text('Processing...')
                            .on('click', function () {
                                var $this = $(this),
                                        data = $this.data();
                                $this
                                        .off('click')
                                        .text('Abort')
                                        .on('click', function () {
                                            $this.remove();
                                            data.abort();
                                        });
                                data.submit().always(function () {
                                    $this.remove();
                                });
                            });

            $('#fileupload').bind('fileuploadsubmit', function (e, data) {
                var inputs = data.context.find(':input');
                if (inputs.filter(function () {
                            return !this.value && $(this).prop('required');
                        }).first().focus().length) {
                    data.context.find('button').prop('disabled', false);
                    return false;
                }
                data.formData = inputs.serializeArray();
            });

            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                Upload: false,
                acceptFileTypes: /(\.|\/)(pdf|dwf)$/i,
                uploadTemplateId: 'template-upload',
                downloadTemplateId: null,
                maxFileSize: 10000000,
                // Enable image resizing, except for Android and Opera,
                // which actually support image resizing, but fail to
                // send Blob objects via XHR requests:
                disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                previewMaxWidth: 100,
                previewMaxHeight: 100,
                previewCrop: true
            }).on('fileuploadadd', function (e, data) {
                data.context = $('<div/>').appendTo('#files');
                $.each(data.files, function (index, file) {
                    var node = $('<p/>')
                            .append($('<span/>').text(file.name));
                    if (!index) {
                        node
                                .append('<br>')
                                .append(uploadButton.clone(true).data(data));
                    }
                    node.appendTo(data.context);
                });



            }).on('fileuploadprocessalways', function (e, data) {
                var index = data.index,
                        file = data.files[index],
                        node = $(data.context.children()[index]);
                if (file.preview) {
                    node
                            .prepend('<br>')
                            .prepend(file.preview);
                }
                if (file.error) {
                    node
                            .append('<br>')
                            .append($('<span class="text-danger"/>').text(file.error));
                }
                if (index + 1 === data.files.length) {
                    data.context.find('button')
                            .text('Upload')
                            .prop('disabled', !!data.files.error);
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            }).on('fileuploaddone', function (e, data) {
                $.each(data.files, function (index, file) {
                    var fileName = $('<td class=""/>').text('Added file: ' + file.name);
                    var size = $('<td class=""/>').text('Size: ' + file.size);
                    var message = $('<td style="color:green" class="fa fa-check fa-2x"/>').text(data.result.message);
                            var node = $('<tr/>')
                                    .append(fileName)
                                    .append(size)
                                    .append(message);
                            node.appendTo('.files');
                });

            }).on('fileuploadfail', function (e, data) {
                $.each(data.files, function (index) {
                    var error = $('<span class="text-danger"/>').text('File upload failed.');
                    $(data.context.children()[index])
                            .append('<br>')
                            .append(error);
                });
//            }) .on('fileuploadchunksend', function (e, data) {
//                $('#chunk').val('true');
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>

    <script>

        Dropzone.options.addPhotosForm = {
            maxFilesize: 2,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp'
        };

    </script>
@stop
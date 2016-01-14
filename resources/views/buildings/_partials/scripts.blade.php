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

<script>


    $(document).ready(function () {

        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var info = $('.info');
        var flash = $('.flash_message');

        $('.type').change(function (event) {
            var id = $(this).attr('id'); //trying to alert id of the clicked row
            var type_id = $(this).val();


            $.ajax({
                dataType: "json",
                type:   "POST",
                url:    '{{ Route('updateType') }}',
                data: {id: id, type_id: type_id, _token: csrf_token}
            }).done(function(data){
                info.hide().find('ul').empty();
                flash.find('p').append(data.message);
                flash.slideDown();
                $(".alert").delay(2500).addClass("in").slideUp(2000);
            }).fail(function() {
                var errors = data.responseJSON;
                $.each(errors, function(index,error){
                    info.find('ul').append('<li>'+error+'</li>');
                });
                info.slideDown();
                info.delay(2500).addClass("in").slideUp(3000);
            });
            info.hide().find('ul').empty();
            flash.find('p').empty();
        });




        $('.location').change(function (event) {
            var id = $(this).attr('id'); //trying to alert id of the clicked row
            var location_id = $(this).val();


            $.ajax({
                dataType: "json",
                type:   "POST",
                url:    '{{ Route('updateLocation') }}',
                data: {id: id, floor_id: location_id, _token: csrf_token}
            }).done(function(data){
                info.hide().find('ul').empty();
                flash.find('p').append(data.message);
                flash.slideDown();
                $(".alert").delay(2500).addClass("in").slideUp(2000);
            }).fail(function() {
                var errors = data.responseJSON;
                $.each(errors, function(index,error){
                    info.find('ul').append('<li>'+error+'</li>');
                });
                info.slideDown();
                info.delay(2500).addClass("in").slideUp(3000);
            });
            info.hide().find('ul').empty();
            flash.find('p').empty();

        });
    });


</script>
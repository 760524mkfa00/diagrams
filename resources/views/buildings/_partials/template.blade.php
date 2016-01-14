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
                <td>{!! Form::select('type', $types, null, ['class' => 'form-control', 'id' => 'type','required']) !!}</td>
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
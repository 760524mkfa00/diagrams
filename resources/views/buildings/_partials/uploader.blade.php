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
        <th>Location</th>
        <th>Type</th>
        <th>Processing<br/><i span="small">(10MB Maximum file size)</i></th>
        <th>Actions</th>
        </thead>
        <tbody class="files"></tbody></table>

</form>
@endcan
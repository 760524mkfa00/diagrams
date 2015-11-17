@extends('../app')
@section('title', 'Permissions')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Permissions
                    </h4>

                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content form-horizontal row-border">
                    <div class="row">
                        <div class="col-md-6">
                            @if($data->count())
                                <table class="table table-hover table-bordered">
                                    @foreach($data as $permission)
                                            <td class="hidden-xs" style="width:9%;">{!! $permission->id !!}</td>
                                            <td>{!! $permission->name !!}</td>
                                            <td>{!! $permission->label !!}</td>
                                            <td class="hidden-xs" style="width:9%;">
                                                <button type="submit" class="open-EditPermissionDialog btn btn-edit pull-right" data-toggle="modal" data-id="{!! $permission->id !!}" data-name="{!! $permission->name !!}" data-label="{!! $permission->label !!}" data-target="#myModal"><i class="fa fa-pencil-square-o"></i></button>
                                            </td>

                                            <td class="hidden-xs" style="width:9%;">
                                                {!! Form::open( array('route' => array('permissions.destroy', $permission->id ),
                                                            'permission' => 'form',
                                                            'method' => 'DELETE')) !!}
                                                <button type="submit" title="Remove" href="{!! URL::route('permissions.destroy', $permission->id) !!}" class="btn btn-delete pull-right"><i class="fa fa-trash-o"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <h5>No Permissions Found, Please Add Permissions</h5>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                {!! Form::open( array('route' => 'permissions.store', 'permission' => 'form')) !!}
                                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                    {!! Form::text('name', NULL, array('class' => 'form-control', 'placeholder' => 'New Name'))!!}
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group {!! $errors->has('label') ? 'has-error' : '' !!}">
                                    {!! Form::text('label', NULL, array('class' => 'form-control', 'placeholder' => 'New Label'))!!}
                                    {!! $errors->first('label', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <a type="button" class="btn btn-default" href="{!! URL::previous() !!}">Back</a>
                                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" permission="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>

                </div>
                <div class="modal-body">
                    {!! Form::hidden('id', NULL, ['class' => 'form-control', 'name' => "id", 'id' => 'permissionID']) !!}
                    <div id="updateBox" class="form-group">
                        {!! Form::text('name', NULL, ['class' => 'form-control', 'name' => "name", 'id' => 'permissionName'])!!}
                        <span class="help-block">Permission Name</span>
                        {!! Form::text('label', NULL, ['class' => 'form-control', 'name' => "label", 'id' => 'permissionLabel'])!!}
                        <span class="help-block">Permission Label</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="update">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).on("click", ".open-EditPermissionDialog", function () {
            var myPermissionId = $(this).data('id');
            var myPermissionName = $(this).data('name');
            var myPermissionLabel = $(this).data('label');

            $(".modal-body #permissionID").val( myPermissionId );
            $(".modal-body #permissionName").val( myPermissionName );
            $(".modal-body #permissionLabel").val( myPermissionLabel );
            // As pointed out in comments,
            // it is superfluous to have to manually call the modal.
            // $('#addBookDialog').modal('show');


            $('#update').click(function(e) {
                e.preventDefault();

                    var name = $('#permissionName').val();
                    var label = $('#permissionLabel').val();

                var modalBody = $(".modal-body");

                $.ajax({
                    type: 'PUT',
                    url: 'permissions/' + myPermissionId,
                    data: {"name": name, "label": label, '_token': '<?php echo csrf_token(); ?>'},
                    dataType: 'json',
                    success: function () {
                        location.reload();
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        modalBody.find('#updateBox').addClass('has-error');
                        $.each(errors, function(index,error){
                            modalBody.find('span').append(error)
                        });
                    }
                });
            });
        });
    </script>
@endsection
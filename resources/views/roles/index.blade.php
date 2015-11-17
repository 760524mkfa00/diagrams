@extends('../app')
@section('title', 'Roles')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Roles
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
                                    @foreach($data as $role)
                                            <td class="hidden-xs" style="width:9%;">{!! $role->id !!}</td>
                                            <td>{!! $role->name !!}</td>
                                            <td>{!! $role->label !!}</td>
                                    <td><a href="{!! URL::route("roles.edit",$role->id) !!}">edit</a></td>
                                            <td class="hidden-xs" style="width:9%;">
                                                <button type="submit" class="open-EditRoleDialog btn btn-edit pull-right" data-toggle="modal" data-id="{!! $role->id !!}" data-name="{!! $role->name !!}" data-label="{!! $role->label !!}" data-target="#myModal"><i class="fa fa-pencil-square-o"></i></button>
                                            </td>

                                            <td class="hidden-xs" style="width:9%;">
                                                {!! Form::open( array('route' => array('roles.destroy', $role->id ),
                                                            'role' => 'form',
                                                            'method' => 'DELETE')) !!}
                                                <button type="submit" title="Remove" href="{!! URL::route('roles.destroy', $role->id) !!}" class="btn btn-delete pull-right"><i class="fa fa-trash-o"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <h5>No Roles Found, Please Add Roles</h5>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                {!! Form::open( array('route' => 'roles.store', 'role' => 'form')) !!}
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>

                </div>
                <div class="modal-body">
                    {!! Form::hidden('id', NULL, ['class' => 'form-control', 'name' => "id", 'id' => 'RoleID']) !!}
                    <div id="updateBox" class="form-group">
                        {!! Form::text('name', NULL, ['class' => 'form-control', 'name' => "name", 'id' => 'RoleName'])!!}
                        <span class="help-block">Role Name</span>
                        {!! Form::text('label', NULL, ['class' => 'form-control', 'name' => "label", 'id' => 'RoleLabel'])!!}
                        <span class="help-block">Role Label</span>
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
        $(document).on("click", ".open-EditRoleDialog", function () {
            var myRoleId = $(this).data('id');
            var myRoleName = $(this).data('name');
            var myRoleLabel = $(this).data('label');

            $(".modal-body #RoleID").val( myRoleId );
            $(".modal-body #RoleName").val( myRoleName );
            $(".modal-body #RoleLabel").val( myRoleLabel );
            // As pointed out in comments,
            // it is superfluous to have to manually call the modal.
            // $('#addBookDialog').modal('show');


            $('#update').click(function(e) {
                e.preventDefault();

                    var name = $('#RoleName').val();
                    var label = $('#RoleLabel').val();

                var modalBody = $(".modal-body");

                $.ajax({
                    type: 'PUT',
                    url: 'roles/' + myRoleId,
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
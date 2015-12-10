@extends('../app')
@section('content')
    <h1>Floors</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>
                        <i class="fa fa-reorder"></i>
                        Floors
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
                                    @foreach($data as $floor)
                                        <tr>
                                            <td class="hidden-xs" style="width:9%;">{!! $floor->id !!}</td>
                                            <td>{!! $floor->name !!}</td>
                                            @can('edit_floor')
                                                <td class="hidden-xs" style="width:9%;">
                                                    <button type="submit" class="open-EditfloorDialog btn btn-edit pull-right" data-toggle="modal" data-id="{!! $floor->id !!}" data-title="{!! $floor->name !!}" data-target="#myModal"><i class="fa fa-pencil-square-o"></i></button>
                                                </td>

                                                <td class="hidden-xs" style="width:9%;">
                                                    {!! Form::open( array('route' => array('floor.destroy', $floor->id ),
                                                                'role' => 'form',
                                                                'method' => 'DELETE')) !!}
                                                    <button type="submit" title="Remove" href="{!! URL::route('floor.destroy', $floor->id) !!}" class="btn btn-delete pull-right"><i class="fa fa-trash-o"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <h5>No floors Found, Please Add floors</h5>
                            @endif
                        </div>
                        @can('edit_floor')
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    {!! Form::open( array('route' => 'floor.store', 'role' => 'form')) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        {!! Form::text('name', NULL, array('class' => 'form-control', 'placeholder' => 'New floor'))!!}
                                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <a type="button" class="btn btn-default" href="{!! URL::previous() !!}">Back</a>
                                        {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endcan
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
                    {!! Form::hidden('id', NULL, ['class' => 'form-control', 'name' => "id", 'id' => 'floorID']) !!}
                    <div id="updateBox" class="form-group">
                        {!! Form::text('floor', NULL, ['class' => 'form-control', 'name' => "floor", 'id' => 'floorName'])!!}
                        <span class="help-block"></span>
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
        $(document).on("click", ".open-EditfloorDialog", function () {
            var myfloorId = $(this).data('id');
            var myfloorName = $(this).data('title');
            $(".modal-body #floorID").val( myfloorId );
            $(".modal-body #floorName").val( myfloorName );
            // As pointed out in comments,
            // it is superfluous to have to manually call the modal.
            // $('#addBookDialog').modal('show');


            $('#update').click(function(e) {
                e.preventDefault();

                var formData = {
                    '_token': '<?php echo csrf_token(); ?>',
                    'floor': $('#floorName').val()
                }

                var modalBody = $(".modal-body");

                $.ajax({
                    type: 'PUT',
                    url: 'floors/' + myfloorId,
                    data: formData,
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
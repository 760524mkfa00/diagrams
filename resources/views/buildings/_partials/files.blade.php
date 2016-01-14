<div class="row">
    <hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <th>Location</th>
            <th>Type</th>
            <th>File Name</th>
            <th>Update</th>
            <th>File Type</th>
            <th>File</th>
            <th></th>
            </thead>
            @foreach($building->plans as $plan)
                <tr>
                    @can('edit_file')
                        {!! Form::open(['route' => ['plans.update',$plan->id], 'method' => 'POST', 'role' => 'form', 'id' => $plan->id, 'class' => 'plan-update']) !!}
                            <td>{!! Form::select('floor_id', $floors, $plan->floor_id, ['class' => 'selectpicker form-control location', 'id' => $plan->id, 'required']) !!}</td>
                            <td>{!! Form::select('type_id', $types, $plan->type_id, ['class' => 'selectpicker form-control type', 'id' => $plan->id, 'required']) !!}</td>
                            <td>{!! Form::text('name', $plan->name, ['class' => 'form-control name', 'id' => $plan->id, 'required']) !!}</td>
                            <td>{!! Form::submit('Update',['class' => 'btn btn-primary']) !!}</td>
                        {!! Form::close() !!}
                    @else
                        <td>{!! Form::select('floor', $floors, $plan->floor_id, ['class' => 'selectpicker form-control location', 'id' => $plan->id, 'disabled']) !!}</td>
                        <td>{!! Form::select('type', $types, $plan->type_id, ['class' => 'selectpicker form-control type', 'id' => $plan->id, 'disabled']) !!}</td>
                        <td>{{ $plan->name }}</td>
                    @endcan

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
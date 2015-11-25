@extends('app')
@section('title', 'Buildings')
@section('content')
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <th>Building Name</th>
                <th>Address</th>
                <th>Building Type</th>
                </thead>
                @foreach($data as $building)
                    <tr>
                        <td><a href="buildings/{!! $building->building_name !!}/{!! $building->street !!}">{!! $building->building_name !!}</a></td>
                        <td>{!! $building->street !!}</td>
                        <td>{!! $building->building_type !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop

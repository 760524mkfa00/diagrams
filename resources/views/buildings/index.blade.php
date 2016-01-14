@extends('app')
@section('title', 'Buildings')
@section('content')
    <h1>Buildings</h1>
    <div class="widget box">
        <div class="widget-header">
            <h4>
                <i class="fa fa-reorder"></i>
                Building List
            </h4>

            <div class="toolbar no-padding">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content form-horizontal row-border">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <th>Building Name</th>
                            <th>Address</th>
                            <th>Building Type</th>
                            </thead>
                            @foreach($data as $building)
                                <tr>
                                    <td><a href="{{ route('showBuilding', [$building->building_name, $building->street])  }}">{!! $building->building_name !!}</a></td>
                                    <td>{!! $building->street !!}</td>
                                    <td>{!! $building->building_type !!}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@stop

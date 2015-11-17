@extends('../app')
@section('title', 'Contacts')

@section('content')
    <div class="widget box">
        <div class="widget-header">
            <h4>
                <i class="fa fa-reorder"></i>
                Contact List
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
                        <table class="table table-hover table-striped table-bordered table-highlight-head">
                            <thead>
                            <th class="hidden-xs">Last Name</th>
                            <th class="hidden-xs">First Name</th>
                            <th class="hidden-sm hidden-md hidden-lg">Name</th>
                            <th class="hidden-xs hidden-sm">Partner Name</th>
                            <th class="hidden-xs">City</th>
                            <th class="hidden-xs">Phone</th>
                            <th class="hidden-xs">Cell</th>
                            <th class="hidden-sm hidden-md hidden-lg">Numbers</th>
                            <th class="hidden-xs hidden-sm">Position</th>
                            </thead>
                            @foreach($data as $user)
                                <tbody>
                                <tr>
                                    <td class="hidden-xs">{{ $user->last_name }}</td>
                                    <td class="hidden-xs">{{ $user->first_name }}</td>
                                    <td class="hidden-sm hidden-md hidden-lg">{{ $user->last_name . ', ' . $user->first_name }}</td>
                                    <td class="hidden-xs hidden-sm">{{ $user->partner_name }}</td>
                                    <td class="hidden-xs">{{ $user->city }}</td>
                                    <td class="hidden-xs">{{ $user->phone }}</td>
                                    <td class="hidden-xs">{{ $user->cell }}</td>
                                    <td class="hidden-sm hidden-md hidden-lg">{!! $user->phone . '<br>' . $user->cell !!}</td>
                                    <td class="hidden-xs hidden-sm">{{ $user->position }}</td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-footer">
                <div class="col-md-6">
                    <div class="table-actions">
                        <a type="button" class="btn btn-primary" href="{{ URL::route('users.create') }}">Add New</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dataTables_paginate">
                        {{--                        {{ $users->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
@extends('app')
@section('content')

    <div class="alert alert-info info" style="display:none;">
        <ul></ul>
    </div>
    <div class="flash_message alert alert-info" style="display: none;">
        <p></p>
    </div>



    <div class="row">
        <div class="col-md-6">
            <h2>{{ $building->building_name }}
                @can('edit_file')
                    <a href="{{ route('editBuilding',[$building->building_name,  $building->street])  }}"><i class="fa fa-pencil-square"></i></a>
                @endcan
            </h2>

            <h3>{{ $building->street . ', ' . $building->postal }}</h3>
            <hr>
            <p>{!! nl2br($building->description) !!}</p>
            <hr>
            @include('buildings._partials.images')
            @include('buildings._partials.files')
        </div>
        <div class="col-md-6">
            @include('buildings._partials.dropzone')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('buildings._partials.uploader')
        </div>
    </div>


@stop

@section('footer')

    @include('buildings._partials.template')
    @include('buildings._partials.scripts')

@stop
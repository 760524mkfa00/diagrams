<div class="row">
    <div class="col-md-12">
        @foreach($building->pictures->chunk(4) as $set)
            <div class="row">
                @foreach($set as $picture)
                    <div class="col-md-3">
                        @can('delete_picture')
                        <form method="POST" action="{{ Route('removePicture',[$picture->id]) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">Delete</button>
                        </form>
                        @endcan
                        <a href="{{ asset($picture->path) }}" data-lity>
                            <img src="{{ asset($picture->thumbnail_path) }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
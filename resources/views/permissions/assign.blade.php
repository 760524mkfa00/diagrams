    <div class="assign">
        @foreach ($permissions as $permission)
            <div class="checkbox">
                {!! Form::checkbox("permission_id[]", $permission->id, $roles->permissions->contains($permission->id)) !!}
                {!! $permission->label !!}
            </div>
        @endforeach
    </div>
<div class="assign">
    @foreach ($users as $user)
        <div class="checkbox">
            {!! Form::checkbox("user_id[]", $user->id, $roles->users->contains($user->id)) !!}
            {!! $user->first_name . ' ' . $user->last_name !!}
        </div>
    @endforeach
</div>
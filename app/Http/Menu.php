<?php

Event::listen('build.menu', function(Plans\Events\menuRequested $event) {
    $event->add('buildings', 'Buildings', 'javascript:void(0);', 100, 'building');
    $event->add('buildings.index', 'Buildings', URL::route('buildings.index'), 101, 'angle-right');
    if (Gate::allows('create_building'))
    {
        $event->add('buildings.create', 'New', URL::route('buildings.create'), 102, 'angle-right');
    }
    $event->add('floors', 'Floors', URL::route('floor.index'), 202, 'angle-right');

    if (Gate::allows('edit_users'))
    {
        $event->add('users', 'Users', 'javascript:void(0);', 500, 'users');
        $event->add('users.current', 'Current', URL::route('users.index'), 501, 'angle-right');
        $event->add('users.create', 'New', URL::route('users.create'), 502, 'angle-right');
        $event->add('users.roles', 'Roles', URL::route('roles.index'), 503, 'angle-right');
        $event->add('users.permissions', 'Permissions', URL::route('permissions.index'), 504, 'angle-right');
    }
});
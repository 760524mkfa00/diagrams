<?php

Event::listen('build.menu', function(Fieldtrip\Events\menuRequested $event)
{

    $event->add('index', 'Dashboard', URL::route('home'), 1, 'dashboard');
    if (Gate::allows('edit_fieldtrips')) {
        $event->add('fieldtrip', 'Field Trips', 'javascript:void(0);', 5, 'desktop');
        $event->add('fieldtrip.current', 'Current', URL::route('fieldtrips.index'), 2, 'angle-right');
        $event->add('fieldtrip.create', 'New', URL::route('fieldtrips.create'), 3, 'angle-right');
    }
    $event->add('zone', 'Zones',  URL::route('zones.index'), 20, 'pie-chart');
    $event->add('route', 'Routes', 'javascript:void(0);', 30, 'bus');
    $event->add('route.current', 'Current',  URL::route('routes.index'), 31, 'angle-right');
    if (Gate::allows('create_routes')) {
        $event->add('route.create', 'New', URL::route('routes.create'), 32, 'angle-right');
    }
    if (Gate::allows('edit_users'))
    {
        $event->add('users', 'Users', 'javascript:void(0);', 500, 'users');
        $event->add('users.current', 'Current',  URL::route('users.index'), 501, 'angle-right');
        $event->add('users.create', 'New',  URL::route('users.create'), 502, 'angle-right');
        $event->add('users.roles', 'Roles',  URL::route('roles.index'), 503, 'angle-right');
        $event->add('users.permissions', 'Permissions',  URL::route('permissions.index'), 504, 'angle-right');
    }
    if (Gate::allows('edit_adjustments')) {
        $event->add('actuals', 'Adjustments', 'javascript:void(0);', 600, 'unsorted');
        $event->add('actuals.dates', 'Dates', URL::route('actuals.index'), 601, 'angle-right');
        $event->add('actuals.hours', 'Hours', URL::route('adjustments.index'), 602, 'angle-right');
    }
    if (Gate::allows('manage_reports')) {
        $event->add('reports', 'Reports', 'javascript:void(0);', 700, 'bug');
        $event->add('reports.overtime', 'OT Offered', URL::route('overtime'), 701, 'angle-right');
        $event->add('reports.calendar', 'Calendar', URL::route('calendar'), 702, 'angle-right');
    }
    $event->add('contacts', 'Contacts',  URL::route('contacts'), 800, 'phone');
});
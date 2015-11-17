<div class="page-header">
    <div class="page-title">
        <h3>@yield('title')</h3>
        <span>
            @if(Request::is( 'dashboard*'))
                Good {{ (date('H') < 12 ? 'Morning' : 'Afternoon') }} {{ Auth::user()->Firstname }}
            @else
                @yield('sub-title')
            @endif
            </span>
    </div>
</div>
    <header class="header navbar navbar-fixed-top" role="banner">
        <div class="container">
            <!-- Only visible on smartphones, menu toggle -->
            <ul class="nav navbar-nav">
                <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="fa fa-bars"></i></a></li>
            </ul>

            <!-- Logo -->
            <a class="navbar-brand" href="/buildings">
                {!! HTML::image('img/logo.png', 'Floor Plans Logo') !!}
            </a>
            <!-- /logo -->
            <!-- Sidebar Toggler -->
            <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
                <i class="fa fa-bars"></i>
            </a>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                   <li class="dropdown user">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                       <i class="fa fa-male"></i>
                       <span class="username">{{ Auth::user()->first_name ? Auth::user()->first_name . ' ' . Auth::user()->last_name : Auth::user()->email }}</span>
                       <b class="fa fa-caret-down small"></b></a>
                       <ul class="dropdown-menu">
                           <li><a href="{{ URL::route('users.edit', Auth::user()->id) }}"><i class="fa fa-pencil"></i> Profile</a></li>
                           <li class="divider"></li>
                           <li><a href="{{ URL::to('/auth/logout') }}"><i class="fa fa-sign-out"></i> Log Out</a></li>
                       </ul>
                   </li>
                @else
                   <li><a href="{{ URL::to('/auth/login') }}">Log In</a></li>
                @endif
            </ul>
        </div>

    </header>

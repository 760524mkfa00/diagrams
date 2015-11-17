

 <!-- /Sidebar Toggler -->
        <div id="sidebar" class="sidebar-fixed">
            <div id="sidebar-content">
                @if(Request::is( 'fieldtrips*'))
                    {!! Form::open(array('method' => 'GET',
                                        'class' => 'sidebar-search',
                                        'role' => 'form')) !!}
                    <div class="input-box">
                        <button type="submit" class="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <span>{!! Form::input('search', 'q', null, ['placeholder' => 'Search...', 'class' => 'form-control']) !!}</span>
                    </div>
                    {!! Form::close() !!}
                @endif

                <!--=== Navigation ===-->


                {!!    Fieldtrip\Events\menuRequested::create(function($event) {
                    \Event::fire('build.menu', $event);
                    })->render();
                !!}


                <!-- /Navigation -->

            </div>
            <div id="divider" class="resizeable"></div>
        </div>

 <!-- /Sidebar -->
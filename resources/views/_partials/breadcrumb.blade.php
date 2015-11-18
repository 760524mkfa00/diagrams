<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="/dashboard">Dashboard</a>
						</li>
						@if(Request::is( 'dashboard*'))

						@else
							<li class="current">
								<a href="#" title="">@yield('title')</a>
							</li>
						@endif
					</ul>

					{{--<ul class="crumb-buttons">--}}
						{{--<li><a href="#" title=""><i class="fa fa-signal"></i><span>Statistics</span></a></li>--}}
						{{--<li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="fa fa-tasks"></i><span>Users <strong>(+3)</strong></span><i class="fa fa-angle-down left-padding"></i></a>--}}
							{{--<ul class="dropdown-menu pull-right">--}}
							{{--<li><a href="#" title=""><i class="fa fa-plus"></i>Add new User</a></li>--}}
							{{--<li><a href="#" title=""><i class="fa fa-reorder"></i>Overview</a></li>--}}
							{{--</ul>--}}
						{{--</li>--}}
						{{--<li class="range"><a href="#">--}}
							{{--<i class="fa fa-calendar"></i>--}}
							{{--<span></span>--}}
							{{--<i class="fa fa-angle-down"></i>--}}
						{{--</a></li>--}}
						{{--<li class="range"><a href="#">--}}
						    {{--<i class="fa fa-calendar"></i>--}}
						    {{--<span>{{ date('F d, Y') }}</span>--}}
						{{--</a></li>--}}
					{{--</ul>--}}
				</div>
				<!-- /Breadcrumbs line -->
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Floor Plans</title>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
	<link href="{!! asset('css/all.css') !!}" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Scripts -->

	{!! HTML::script('js/all.js') !!}

	{!! HTML::script('js/daterangepicker/moment.min.js') !!}
	{!! HTML::script('js/daterangepicker/daterangepicker.js') !!}
	{!! HTML::script('js/blockui/jquery.blockUI.min.js') !!}


	{!! HTML::script('js/libs/breakpoints.js') !!}



	<!-- App -->
	{!! HTML::script('js/app.js') !!}
	{!! HTML::script('js/plugins.js') !!}

	<script>
		$(document).ready(function(){
			"use strict";

			App.init(); // Init layout and core plugins
			Plugins.init(); // Init all plugins

            // hide #back-top first
            $("#back-top").hide();

            // fade in #back-top
            $(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });

                // scroll body to 0px on click
                $('#back-top a').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });


		});

	</script>

</head>
<body onload="initialize()">
	@include ('../_partials.flashMessage')
	@include ('_partials.nav')

	<div id="container">
		{{--@include ('_partials.sidebar')--}}
		@include ('_partials.menu')
		<div id="content">
			<div class="container">
				@include ('_partials.breadcrumb')
				@yield('content')
			</div>
		</div>
	</div>


	@yield('footer')
</body>
</html>

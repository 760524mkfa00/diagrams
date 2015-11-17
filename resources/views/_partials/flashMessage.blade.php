@if (Session::has('message'))
	<div class="flash_message alert alert-info">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif

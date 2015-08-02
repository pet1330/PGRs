<!DOCTYPE html>
<html lang="en">
<head>
	@include('global.includes.auth_head')
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				@yield('content')
			</div>
		</div>
	</div>
</body>
</html>
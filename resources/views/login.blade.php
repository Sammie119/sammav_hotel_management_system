<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HMS | Login</title>
    <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/x-icon">
    <link href="{{ asset('public/assets/css/bootstrap-5.2.0-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/login-style.css') }}">

	{{-- Alert css --}}
    <link rel="stylesheet" href="{{ asset('public/assets/js/alert/toastr_alert.css') }}">

</head>

<body>
	<section class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
					<form action="login" method="POST" autocomplete="off">
						@csrf
						<h3>Welcome!</h3>
						<input type="text" name="username" placeholder="USERNAME" autofocus required>
						<input type="password" name="password" placeholder="PASSWORD" required>
						<button class="submit" type="submit">LOG IN</button>
					</form>
				</div>

                <div class="form-footer">
                    <small><i><b>SAMMAV I.T</b> Consult (0248376160 / 0556226864)</i></small>
                </div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2>{{ nameOfInstitution() }}</h2>
					<h5>Hotel Management System</h5>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('public/assets/css/bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/alert/toastr_alert.js') }}"></script>

	@if(Session::has('error'))
        <script>
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("{!! Session::get('success') !!}");
        </script>
    @endif

</body>
</html>
</html>
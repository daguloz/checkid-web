<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>CheckID - Panel de control</title>

		<!-- CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/panel.css">

		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<h1>CheckID</h1>
									
						<div class="row">
							<div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
								<?php if (isset($error)) echo '<div class="alert alert-danger" role="alert">' . $error . '</div>'; ?>
								<form method="POST" action="login">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control text-center" id="email" name="email" placeholder="Introduce tu email" required />
									</div>
									<div class="form-group">
										<label for="passsword">Contraseña</label>
										<input type="password" class="form-control text-center" id="password" name="password" placeholder="Contraseña" required />
									</div>
									<div class="checkbox">
									<label>
								    	<input type="checkbox" name="save"> Recordar usuario
									</label>
									</div>
									<button type="submit" class="btn btn-primary">Iniciar sesión</button>
								</form>
							</div>
						</div>

				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 text-center spacer">
					<p><small>Página renderizada en <strong>{elapsed_time}</strong> segundos.</small></p>
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/panel.js"></script>
	</body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 spacer">
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation"<?php if ($section === 'dashboard') echo ' class="active"'?>><a href="panel">Panel CheckID</a></li>
						<li role="presentation"<?php if ($section === 'devices') echo ' class="active"'?>><a href="dispositivos">Dispositivos</a></li>
						<li role="presentation"<?php if ($section === 'readings') echo ' class="active"'?>><a href="registros">Registros</a></li>
						<li role="presentation"<?php if ($section === 'users') echo ' class="active"'?>><a href="usuarios">Usuarios</a></li>
						<li role="presentation"<?php if ($section === 'config') echo ' class="active"'?>><a href="configuracion">Configuración</a></li>
					</ul>
					<div class="row">
						<div class="col-xs-12 text-center spacer">
							<p><small>Página renderizada en <strong>{elapsed_time}</strong> segundos.</small></p>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 spacer">
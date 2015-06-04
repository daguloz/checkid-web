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
		<link rel="stylesheet" href="css/chosen.min.css">
		<link rel="stylesheet" href="css/panel.css">

		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-header">
					<h1>CheckID - Panel de control</h1>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 spacer">
					<ul class="nav nav-pills nav-stacked">
						<?php
						foreach ($sections as $sName => $sData) {
							echo '<li role="presentation"';
							if ($section === $sName)
								echo ' class="active"';
							echo '><a href="' . $sData['url'] . '">';
							echo $sData['desc'];
							if ($section === $sName)
								echo '<span class="pull-right glyphicon glyphicon-chevron-right"></span>';
							echo '</a></li>';
						}
						?>
					</ul>
					<div class="row">
						<div class="col-xs-12 text-center spacer">
							<!-- <p><small>Página renderizada en <strong>{elapsed_time}</strong> segundos.</small></p> -->
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
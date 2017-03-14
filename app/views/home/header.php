<!DOCTYPE html>
<html lang="en-GB">

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>mvc.local</title>

		<link rel="stylesheet" type="text/css" href="https://assets.davidhunter.scot/bootstrap/3.3.7/css/bootstrap.min.css" />

	</head>

	<body>

		<header>
			<div class="container">
				<h1>mvc.local <small>A web-based application built using an MVC-style framework.</small></h1>
				<nav>
					<?php 

					global $routing;

					$routes = $routing->getAll(new HomeController);

					$routesOutput = "";

					foreach ($routes as $routeName => $routeInfo) {
						$routesOutput .= "<a href=\"" . $routing->url( $routeName ) . "\">" . ucwords( str_replace(['/', '-', '_'], " ", $routeName) ) . "</a> | ";
					}

					$routesOutput = substr($routesOutput, 0, -3);

					echo $routesOutput;

					?>
				</nav>
			</div>
		</header>

		<div class="container">

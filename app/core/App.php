<?php

class App {

	/*
		MAIN APP PROCESSING CLASS

		Think of this class as like the central brains of the operation.
	*/

	public function __construct() {
		// Grab the current route from the GET $url query string parameter,
		// passed in using mod_rewrite in our .htaccess file.
		$currentRoute = isset($_GET['url']) ? $_GET['url'] : "";

		// Mark the $routing variable as global so we can access the
		// instance of our Routing class from init.php.
		global $routing;

		// Require our HomeController class file,
		require_once "../app/controllers/HomeController.php";
		// and create an instance of it.
		$homeController = new HomeController;

		// Register the routes we want to be available and define their callable action.
		$routing->register("home", "", [$homeController, 'index']);
		$routing->register("users", "users", [$homeController, 'users']);
		$routing->register("login", "login", [$homeController, 'login']);

		// Check if the Current Route grabbed previously and stored in $currentRoute
		// matches any of our registered routes.
		if( $routing->check($currentRoute) ) {
			// Match found, call its callable action.
			call_user_func($routing->get($currentRoute)['callable']);
		} else {
			// Match not found.

			// Output the correct header information,
			header("HTTP/1.0 404 Not Found");
			// and display a friendly message.
			echo "Content Not Found!";
		}
	}

}
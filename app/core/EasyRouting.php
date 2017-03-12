<?php

class EasyRouting {

	/*
		EASY ROUTING SYSTEM - Matches routes against controllers and methods that exist.

		Replaced by BASIC ROUTING SYSTEM (BasicRouting.php)
	*/

	// Default Controller
	protected $controller = "home";
	// Default Method
	protected $method = "index";
	// Default Parameters
	protected $params = [];

	public function __construct() {
		// Parse the GET $url variable which turns it into a useful array for us to process.
		$url = $this->parseUrl();

		// Check that the array has at least one element in it,
		// and if a file exists in the same name.
		if( count( $url ) >= 1 && file_exists('../app/controllers/' . $url[0] . '.php') ) {
			// At least one element exists, and a file exists in the same name.

			// That element's value is the name of our controller. Remember it as such.
			$this->controller = $url[0];
			// Unset that value from our URL array.
			unset( $url[0] );
			// Rebase the URL array so element keys start from zero again.
			$url = array_values( $url );
		}

		// Require in our controller file. This will either be the default one or the requested one if it exists.
		require_once '../app/controllers/' . $this->controller . '.php';

		// Now check if a method has been requested by checking if the URL array still has at least one element,
		// and if a method within our controller exists in the same name.
		if( count( $url ) >= 1 && method_exists($this->controller, $url[0]) ) {
			// Yes at least one element exists in our URL array, and it matches a method within our controller.

			// Replace the default method above with the requested method.
			$this->method = $url[0];
			// Unset it from our URL array.
			unset( $url[0] );
			// Rebase the URL array so element keys start from zero again.
			$url = array_values( $url );
		}

		// Do we still have any elements in our URL array by this point in processing?
		if( count( $url ) >= 1 ) {
			// Yes we do. Save them and use them as parameters.
			$this->params = $url;
		}

		// Create an object of the requested controller class.
		$obj = new $this->controller;

		// Call the requested method and pass any parameters to it.
		call_user_func_array([$obj, $this->method], $this->params);
	}

	public function parseUrl() {
		// Does a URL exist in the request?
		if( isset( $_GET['url'] ) ) {
			// Yes, let's grab it.
			$url = $_GET['url'];
			// Trim excess trailing slashes
			$url = rtrim( $url, '/' );
			// Sanitize it
			$url = filter_var( $url, FILTER_SANITIZE_URL );
			// Explode it
			$url = explode("/", $url);
			// Return it
			return $url;
		}
	}

}
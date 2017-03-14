<?php

class BasicRouting {

	/*
		BASIC ROUTING SYSTEM - Keeps track of all routes and their callable actions.
	*/

	private $routes = [];

	/*
	 * Registers a route.
	 */
	public function register($name, $route, $callable) {
		if( !is_string($name) ) return false;
		if( !is_string($route) ) return false;
		if( !is_callable($callable) ) return false;
		
		$this->routes[$name] = ['route' => ltrim($route, '/'), 'callable' => $callable];
	}

	/*
	 * Checks if a route exists.
	 */
	public function check($route) {
		if( count( $this->routes ) >= 1 ) {
			foreach ($this->routes as $routeName => $routeInfo) {
				if( $routeInfo['route'] == $route )
					return true;
			}
		}
		return false;
	}

	/*
	 * Gets the requested route information if it exists.
	 */
	public function get($route) {
		if( count( $this->routes ) >= 1 ) {
			foreach ($this->routes as $routeName => $routeInfo) {
				if( $routeInfo['route'] == $route )
					return ['name' => $routeName, 'route' => $routeInfo['route'], 'callable' => $routeInfo['callable']];
			}
		}
		return false;
	}

	/*
	 * Returns an array of registerd routes.
	 * If you pass a controller instance as a parameter,
	 * it will match only the routes that use an instance of that controller.
	 */
	public function getAll($controller = null) {
		// Has the $controller parameter been provided?
		if( $controller ) {
			// Is it a valid Controller instance?
			if( $controller instanceof Controller ) {
				// A valid controller instance has been provided.

				// Create an empty array to hold the routes.
				$routes = [];

				// Loop through all registered routes.
				foreach ($this->routes as $routeName => $routeInfo) {
					// Check if the current route's callable action class instance is
					// an instance of the same controller class as the requested.
					if( $routeInfo['callable'][0] == $controller ) {
						// It is, let's add it to our routes array for later.
						$routes[$routeName] = $routeInfo;
					}
				}
				// After we have looped through the routes, and picked out those that match,
				// return the array of matched routes.
				return $routes;
			}
			// The provided controller parameter is not a valid controller instance.
			// Return an empty array.
			return [];
		}
		// No controller parameter was provided, return all registered routes.
		return $this->routes;
	}

	/*
	 * Redirects to the requested route if it exists.
	 */
	public function redirect($name) {
		global $config;

		if( $this->check($name) ) {
			$route = $this->routes[$name]['route'];
			header("Location: " . $config->getSiteRootURL() . "/" . $route);
			exit;
		}
		return false;
	}

	/*
	 * Generates a full site URL to the requested route if it exists.
	 */
	public function url($name) {
		global $config;

		if( array_key_exists($name, $this->routes) ) {
			$route = $this->routes[$name]['route'];
			return $config->getSiteRootURL() . '/' . $route;
		}
		return false;
	}

}
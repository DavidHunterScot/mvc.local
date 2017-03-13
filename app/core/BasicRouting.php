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
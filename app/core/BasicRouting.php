<?php

class BasicRouting {

	/*
		BASIC ROUTING SYSTEM - Keeps track of all routes and their callable actions.
	*/

	private $routes = [];

	public function register($name, $route, $callable) {
		if( !is_string($name) ) return false;
		if( !is_string($route) ) return false;
		if( !is_callable($callable) ) return false;
		
		$this->routes[$name] = ['route' => ltrim($route, '/'), 'callable' => $callable];
	}

	public function check($route) {
		if( count( $this->routes ) >= 1 ) {
			foreach ($this->routes as $routeName => $routeInfo) {
				if( $routeInfo['route'] == $route )
					return true;
			}
		}
		return false;
	}

	public function get($route) {
		if( count( $this->routes ) >= 1 ) {
			foreach ($this->routes as $routeName => $routeInfo) {
				if( $routeInfo['route'] == $route )
					return ['name' => $routeName, 'route' => $routeInfo['route'], 'callable' => $routeInfo['callable']];
			}
		}
		return false;
	}

	public function redirect($name) {
		global $config;

		if( $this->check($name) ) {
			$route = $this->routes[$name]['path'];
			header("Location: " . $config->getSiteRootURL() . "/" . $route);
			exit;
		}
	}

}
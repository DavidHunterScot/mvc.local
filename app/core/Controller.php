<?php

class Controller {

	public function model($model) {
		if( file_exists('../app/models/' . $model . '.php') ) {
			require_once '../app/models/' . $model . '.php';
			return new $model;
		}
	}

	public function view($view, $data = []) {
		// Check if the data properties of "header-view" and "footer-view" were provided.
		if( array_key_exists("header-view", $data) && array_key_exists("footer-view", $data) ) {
			// They were, so let's see if they exist.
			if( file_exists("../app/views/" . $data['header-view'] . ".php") && file_exists("../app/views/" . $data['footer-view'] . ".php") ) {
				// They do exist, so let's assume that these are the header and footer views to be rendered.

				// Save their values into variables.
				$header_view = $data['header-view'];
				$footer_view = $data['footer-view'];

				// Unset them from the data array.
				unset($data['header-view']);
				unset($data['footer-view']);
			}
		}

		// Does the requested view exist?
		if( file_exists('../app/views/' . $view . '.php') ) {
			// The view exists.

			// Check if we have a header view to render.
			if (isset($header_view)) {
				// We do, so let's render it.
				require_once '../app/views/' . $header_view . '.php';
			}
			
			// Now to render the requested view.
			require_once '../app/views/' . $view . '.php';

			// Check if we have a footer view to render.
			if (isset($footer_view)) {
				// We do, so let's render it.
				require_once '../app/views/' . $footer_view . '.php';
			}
		}
	}

}
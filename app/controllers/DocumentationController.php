<?php

class DocumentationController extends Controller {

	public function index() {
		$this->view("documentation/index", ["header-view" => "documentation/header", "footer-view" => "documentation/footer"]);
	}

	public function classes() {
		$this->view("documentation/classes", ["header-view" => "documentation/header", "footer-view" => "documentation/footer"]);
	}

	public function classForm() {
		$this->view("documentation/classes/Form", ["header-view" => "documentation/header", "footer-view" => "documentation/footer"]);
	}

}
<?php

class Home extends Controller {

	public function index($name = '') {
		$user = $this->model('User');
		$user->name = $name;
		
		$this->view('home/index', ['name' => $user->name]);
	}

	public function users() {
		global $database;
		$database->connect();
		$users = $database->select(['*'], 'users', ['email' => 'david.hunter@personaclix.uk']);

		$this->view('home/users', ['users' => $users]);
	}

	public function login() {
		$accounts = [
			"david@email.com" => "letmein",
			"joe@email.com" => "password"
		];

		$form = new Form;
		$form->setMethod("POST");
		$form->setAction("./login");

		$email = new EmailField("login-email");
		$email->setLabel("E-mail:");
		$form->addField($email);

		$password = new PasswordField("login-password");
		$password->setLabel("Password:");
		$form->addField($password);

		$result = "";

		if( $form->isSubmitted() ) {
			$result = "Invalid";
			if( array_key_exists($email->getValue(), $accounts) ) {
				if( $accounts[ $email->getValue() ] == $password->getValue() ) {
					$result = "Verified";
				}
			}
		}

		$this->view('home/login', ['form' => $form, 'result' => $result]);
	}

}
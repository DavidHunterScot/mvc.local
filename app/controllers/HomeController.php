<?php

class HomeController extends Controller {

	public function index($name = '') {
		// A simple Hello World program here.

		// Request our User model and save it to a variable called $user.
		$user = $this->model('User');
		// Set the name property to the name provided as a parameter.
		$user->name = $name;
		
		// Render the view passing to it the name as set in the model.
		$this->view('home/index', ['name' => $user->name]);
	}

	public function users() {
		// We're going to test if our database class works as expected,
		// most specifically the select() method.

		// In order to access the database instance that exists in our init.php file,
		// we need to define the variable as global.
		global $database;
		// To save a little on resource power, we only connect to the database when we
		// need a database connection. That might change as our software expands.
		// To test our database class's select() method, we need a database connection,
		// so let's connect to our database now using the handy connect() method we created.
		$database->connect();
		// Let's run our select query pulling anything that matches the requested email address
		// from the users table and save it in a variable called $users.
		$users = $database->select(['*'], 'users', ['email' => 'david.hunter@personaclix.uk']);

		// Now render the view and pass to it our matches from the database in the form of the
		// $users variable.
		$this->view('home/users', ['users' => $users]);
	}

	public function login() {
		// Mark the $routing variable as global so we can access
		// the variable located outside the method.
		global $routing;

		// Start creating the form.
		$form = new Form;
		// Set the form's method attribute,
		$form->setMethod("POST");
		// and the action attribute. Here we use the url() method from
		// the routing class to generate a full URL to the login route.
		$form->setAction($routing->url('login'));

		// Create an Email Field with the name "login-email",
		$email = new EmailField("login-email");
		// mark it as required,
		$email->setRequired(true);
		// set it's label,
		$email->setLabel("E-mail:");
		// and add it to the form we created earlier.
		$form->addField($email);

		// Create a Password Field with the name "login-password",
		$password = new PasswordField("login-password");
		// mark it as required,
		$password->setRequired(true);
		// set it's label,
		$password->setLabel("Password:");
		// and add it to the form we created earlier.
		$form->addField($password);

		// Initialise a variable to store the form submission result in.
		$result = "";

		// Check if the form has been submitted.
		if( $form->isSubmitted() && $form->isValid() ) {
			// Form has been submited.

			// In order to access the database instance that exists in our init.php file,
			// we need to define the variable as global.
			global $database;

			// Connect to the database.
			$database->connect();
			
			// Query the database for and select the user matching the provided email address.
			// We need to set the index of 0 here as we are only interested in the first result.
			$user = $database->select(['*'], 'users', ['email' => $email->getValue()])[0];

			// Check if the provided email address matches a user in the database.
			if( isset($user['email']) && $user['email'] == $email->getValue() ) {
				// It does match, lets check if the provided password is also a match.
				if( $user['password'] == $password->getValue() ) {
					// Password is a match, so let's change the result to "Verified".
					$result = "Verified";
				} else {
					$result = "Incorrect E-mail and/or Password";
				}
			} else {
				$result = "Incorrect E-mail and/or Password";
			}
		} else if( $form->isSubmitted() && !$form->isValid() ) {
			$result = "Missing Required Fields";
		}

		// Render our view and pass to it the instance of our form, and the form submission result.
		$this->view('home/login', ['form' => $form, 'result' => $result]);
	}

}
<?php

class FormField {

	private $type, $name, $id, $class, $value, $required = false, $label;

	protected function setType($type) { $this->type = $type; }
	protected function setName($name) { $this->name = $name; }

	public function setId($id) { $this->id = $id; }
	public function setClass($class) { $this->class = $class; }
	public function setValue($value) { $this->value = $value; }
	public function setRequired($required) { $this->required = is_bool($required) ? $required : false; }
	public function setLabel($label) { $this->label = $label; }

	public function getType() { return $this->type; }
	public function getName() { return $this->name; }
	public function getId() { return $this->id; }
	public function getClass() { return $this->class; }
	public function getValue() { return $this->value; }
	public function isRequired() { return $this->required; }
	public function getLabel() { return $this->label; }

}

class TextField extends FormField {

	public function __construct($name) {
		$this->setType("text");
		$this->setName($name);
		$this->setId($name);
	}

}

class EmailField extends FormField {

	public function __construct($name) {
		$this->setType("email");
		$this->setName($name);
		$this->setId($name);
	}

}

class PasswordField extends FormField {

	public function __construct($name) {
		$this->setType("password");
		$this->setName($name);
		$this->setId($name);
	}

}
<?php

class Form {

	private $method, $action, $name, $id, $fields = [];

	public function setMethod($method) { if( strtoupper( $method ) == "POST" ) $this->method = "POST"; else $this->method = "GET"; }
	public function setAction($action) { $this->action = $action; }
	public function setName($name) { $this->name; }
	public function setId($id) { $this->id = $id; }

	public function addField(FormField $field) { $this->fields[$field->getName()] = $field; }

	public function getMethod() { return $this->method; }
	public function getAction() { return $this->action; }
	public function getName() { return $this->name; }
	public function getId() { return $this->id; }
	public function getFields() { return $this->fields; }

	public function getField( $fieldName ) {
		if( array_key_exists($fieldName, $this->fields) )
			return $this->fields[$fieldName];
		return false;
	}

	public function isSubmitted() {
		if ( is_array( $this->fields ) && count( $this->fields ) >= 1 ) {
			foreach ( $this->fields as $field ) {
				if( $this->method == "POST" ) {
					if( !isset( $_POST[ $field->getName() ] ) )
						return false;

					$field->setValue( $_POST[ $field->getName() ] );
				} else {
					// Assume that the GET method is to be used if anything other than POST.

					if( !isset( $_GET[ $field->getName() ] ) )
						return false;

					$field->setValue( $_GET[ $field->getName() ] );
				}
			}
			return true;
		}
		return false;
	}

	public function isValid() {
		if ( is_array( $this->fields ) && count( $this->fields ) >= 1 ) {
			foreach ( $this->fields as $field ) {
				if( $field->isRequired() ) {
					if( $this->method == "POST" ) {
						if( !isset( $_POST[ $field->getName() ] ) || empty( $_POST[ $field->getName() ] ) )
							return false;
					} else {
						if( !isset( $_GET[ $field->getName() ] ) || empty( $_GET[ $field->getName() ] ) )
							return false;
					}
				}
			}
			return true;
		}
		return false;
	}

	public function generateHTML() {
		if ( is_array( $this->fields ) && count( $this->fields ) >= 1 ) {
			$html = "<form";
			if( isset( $this->method ) && $this->method ) $html .= " method=\"" . $this->method . "\"";
			if( isset( $this->action ) && $this->action ) $html .= " action=\"" . $this->action . "\"";
			if( isset( $this->name ) && $this->name ) $html .= " name=\"" . $this->name . "\"";
			if( isset( $this->id ) && $this->id ) $html .= " id=\"" . $this->id . "\"";
			$html .= ">";
			
			foreach ( $this->fields as $field ) {
				if( $field->getLabel() && $field->getId() ) {
					$html .= "<label for=\"" . $field->getId() . "\">" . $field->getLabel() . "</label> ";
				}
				$html .= "<input type=\"" . $field->getType() . "\"";

				if( $field->getName() ) $html .= " name=\"" . $field->getName() . "\"";
				if( $field->getId() ) $html .= " id=\"" . $field->getId() . "\"";
				if( $field->getClass() ) $html .= " class=\"" . $field->getClass() . "\"";
				if( $field->isRequired() ) $html .= " required=\"required\"";
				if( !$field instanceof PasswordField && $field->getValue() ) $html .= " value=\"" . $field->getValue() . "\"";
				
				$html .= " />";
			}

			$html .= "<button type=\"submit\">Submit</button> <button type=\"reset\">Clear</button>";

			$html .= "</form>";
		}

		return $html;
	}

}
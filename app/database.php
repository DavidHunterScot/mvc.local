<?php

class Database {

	private $host, $user, $pass, $name, $PDO;

	public function __construct($host, $user, $pass, $name) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->name = $name;
	}

	public function connect() {
		try {
			$this->PDO = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->name, $this->user, $this->pass);
			return true;
		} catch(PDOException $ex) {
			echo "Error connecting to database!";
			return false;
		}
	}

	public function select($fields, $table, $where = []) {
		// Stop processing and return false if the provided fields parameter is not an array.
		if( !is_array( $fields ) )
			return false;
		// Stop processing and return false if the provided where parameter is not an array.
		if( !is_array( $where ) )
			return false;
		if( !$this->PDO instanceof PDO )
			return false;

		// Instansiate the queryFields variable.
		$queryFields = "";

		// Loop through each of the fields in the provided parameter array.
		for ($f = 0; $f < count($fields); $f++) {
			// Save each field in the queryFields variable we created a moment ago, forming a long string of fields suitable for a database query.
			$queryFields .= $fields[$f] . ',';
		}

		// Remove any trailing commas from the queryFields variable or our database query might not work.
		$queryFields = rtrim($queryFields, ',');

		// Check if the where parameter contains an array with items.
		if( !empty($where) ) {
			
			$queryWhere = "";
			$whereExecute = [];
			$currentWhereIndex = 0;

			foreach ($where as $whereKey => $whereValue) {
				$queryWhere .= $whereKey . " = :" . $whereKey;
				$whereExecute[':' . $whereKey] = $whereValue;

				if( $currentWhereIndex < count($where) - 1 )
					$queryWhere .= " AND ";
			}

			$query = $this->PDO->prepare("SELECT " . $queryFields . " FROM " . $table . " WHERE " . $queryWhere );
			$query->execute($whereExecute);

		} else {
			
			$query = $this->PDO->prepare("SELECT " . $queryFields . " FROM " . $table);
			$query->execute();

		}

		if( $query->rowCount() >= 1 )
			return $query->fetchAll(PDO::FETCH_ASSOC);
		return false;
	}

}
<?php

class Config {

	// Full site root URL where the site can be found,
	// including protocol, and without trailing slash.
	private $siteRootURL = "http://mvc.local";

	private $dbHost = "localhost";
	private $dbUser = "mvc";
	private $dbPass = "fzaqNJdX2NUS6TKW";
	private $dbName = "mvc";

	public function getSiteRootURL() { return $this->siteRootURL; }

	public function getDbHost() { return $this->dbHost; }
	public function getDbUser() { return $this->dbUser; }
	public function getDbPass() { return $this->dbPass; }
	public function getDbName() { return $this->dbName; }

}
<?php

require_once "config.php";
require_once "database.php";
require_once "form.php";
require_once "formField.php";
require_once "core/BasicRouting.php";
require_once "core/App.php";
require_once "core/Controller.php";

$config = new Config;
$database = new Database($config->getDbHost(), $config->getDbUser(), $config->getDbPass(), $config->getDbName());
$routing = new BasicRouting;
$app = new App;
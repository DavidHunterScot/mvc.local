<!DOCTYPE html>
<html lang="en-GB">

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Documentation :: mvc.local</title>

		<link rel="stylesheet" type="text/css" href="https://assets.davidhunter.scot/bootstrap/3.3.7/css/bootstrap.min.css" />

		<style type="text/css">
			.method-title {
				margin-top: 50px;
				margin-bottom: 30px;
				color: #2F9C94;
			}

			.typehint {
				border: 1px solid #2F9C94;
				border-radius: 3px;
				color: #2F9C94;
				padding: 3px 5px;
				font-size: 12px;
			}
		</style>

	</head>

	<body>

		<div class="container">

			<div class="page-heading">
				<h1>Documentation :: mvc.local</h1>
			</div>

			<div class="navigation">
				<p><a href="<?php global $routing; echo $routing->url('documentation/index'); ?>">Index</a> | <a href="<?php echo $routing->url('documentation/classes'); ?>">Classes</a></p>
			</div>

			<div class="content">

<?php

$methods = [
	[
		"name" => "setMethod",
		"desc" => "Sets the form's method attribute.",
		"params" => [
			[
				"param" => "method",
				"desc" => "Acceptable values <code>POST</code> and <code>GET</code>."
			]
		]
	],
	[
		"name" => "setAction",
		"desc" => "Sets the form's action attribute.",
		"params" => [
			[
				"param" => "action",
				"desc" => "The URL where the form submits to."
			]
		]
	],
	[
		"name" => "setName",
		"desc" => "Sets the form's name attribute.",
		"params" => [
			[
				"param" => "name",
				"desc" => "The name to call your form. E.g. <code>login_form</code>"
			]
		]
	],
	[
		"name" => "setId",
		"desc" => "Sets the form's id attribute.",
		"params" => [
			[
				"param" => "id",
				"desc" => "The identifier for your form for use with styles and scripts."
			]
		]
	],
	[
		"name" => "addField",
		"desc" => "Adds a field to your form.",
		"params" => [
			[
				"typehint" => "FormField",
				"param" => "field",
				"desc" => "Instance of class."
			]
		]
	],
	[
		"name" => "getMethod",
		"desc" => "Gets the form's method attribute.",
		"returns" => [
			[
				"param" => "method",
				"desc" => "Possible values <code>POST</code> and <code>GET</code>."
			]
		]
	],
	[
		"name" => "getAction",
		"desc" => "Gets the form's action attribute.",
		"returns" => [
			[
				"param" => "action",
				"desc" => "The URL where the form submits to."
			]
		]
	],
	[
		"name" => "getName",
		"desc" => "Gets the form's name attribute.",
		"returns" => [
			[
				"param" => "name",
				"desc" => "The name you called your form. E.g. <code>login_form</code>"
			]
		]
	],
	[
		"name" => "getId",
		"desc" => "Gets the form's id attribute.",
		"returns" => [
			[
				"param" => "id",
				"desc" => "The identifier for your form for use with styles and scripts."
			]
		]
	],
	[
		"name" => "getFields",
		"desc" => "Gets all the fields attached to the form.",
		"returns" => [
			[
				"typehint" => "FormField",
				"param" => "fields",
				"desc" => "Array of class instances."
			]
		]
	],
	[
		"name" => "getField",
		"desc" => "Gets the instance of the requested field.",
		"params" => [
			[
				"param" => "fieldName",
				"desc" => "The field's name attribute."
			]
		],
		"returns" => [
			[
				"typehint" => "FormField",
				"param" => "field",
				"desc" => "Instance of class."
			]
		]
	]
];

?>
<a name="top"></a>
<h2>class <code>Form</code></h2>

<h4>Methods</h4>

<div class="list-group" style="max-width: 300px;">
	<?php
	foreach ($methods as $method) {
		echo "<a href=\"#{$method['name']}()\" class=\"list-group-item\">{$method['name']}()</a>";
	}
	?>
</div>

<?php
foreach ($methods as $method) {
?>
	<a name="<?php echo $method['name']; ?>()"></a>
	<h4 class="method-title"><?php echo $method['name']; ?>()</h4>
	<p><?php echo $method['desc']; ?></p>

	<?php if( isset( $method['params'] ) ) { ?>
		<p><b>Parameters</b></p>
		<?php foreach ($method['params'] as $param) { ?>
			<p>
				<?php if( isset( $param['typehint'] ) ) { echo '<span class="typehint">' . $param['typehint'] . '</span> '; } ?><code>$<?php echo $param['param']; ?></code> - <?php echo $param['desc']; ?>
			</p>
		<?php } ?>
	<?php } if( isset( $method['returns'] ) ) { ?>
		<p><b>Returns</b></p>
		<?php foreach ($method['returns'] as $return) { ?>
			<p>
				<?php if( isset( $return['typehint'] ) ) { echo '<span class="typehint">' . $return['typehint'] . '</span> '; } ?><code>$<?php echo $return['param']; ?></code> - <?php echo $return['desc']; ?>
			</p>
		<?php } ?>
	<?php } ?>
	<a href="#top">Top of Page</a>
<?php
}
?>
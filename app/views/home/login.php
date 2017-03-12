<?php

$form = $data['form'];

if( $data['result'] ) {
	echo "<p><b>Result:</b> " . $data['result'] . "</p>";
}

//echo $form->generateHtml();

//echo "<pre>" . print_r($form, true) . "</pre>";


?>

<form method="<?php echo $form->getMethod(); ?>" action="<?php echo $form->getAction(); ?>">
	<?php $login_email = $form->getField('login-email'); ?><p><label for="<?php echo $login_email->getId(); ?>"><?php echo $login_email->getLabel(); ?></label><input type="<?php echo $login_email->getType(); ?>" name="<?php echo $login_email->getName(); ?>" id="<?php echo $login_email->getId(); ?>" /></p>
	<?php $login_password = $form->getField('login-password'); ?><p><label for="<?php echo $login_password->getId(); ?>"><?php echo $login_password->getLabel(); ?></label><input type="<?php echo $login_password->getType(); ?>" name="<?php echo $login_password->getName(); ?>" id="<?php echo $login_password->getId(); ?>" /></p>
	<p><button type="submit">Login</button> <button type="reset">Clear</button></p>
</form>

<?php



?>
Edit voor:
<br>
<br>
Username: <?php echo $user->username; ?>
<br>
<br>
<br>

<form action="<?php echo url_for('edit-user', array('userId' => $user->id)); ?>" method="post" name="editUser" id="editUser">
	<?php echo $form; ?>
	<button type="submit">Edit</button>
</form>
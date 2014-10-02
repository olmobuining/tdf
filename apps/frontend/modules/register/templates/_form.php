<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('register/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
 
	<div class="form">
		<div class="row">
			<div class="label">
				<label for="user_username">Gebruikersnaam</label> 
			</div>
			<?php echo $form['username'] ?>
		</div>
		<div class="row">
			<div class="label">
				<label for="user_password">Wachtwoord</label> 
			</div>
			<?php echo $form['password'] ?><div class="okSign"></div>
		</div>
		<div class="row">
			<div class="label">
				<label for="user_password">Wachtwoord check</label> 
			</div>
			<?php echo $form['password_check'] ?><div class="okSign"></div>
		</div>
		<div class="row">
			<div class="label">
				<label for="user_email">Email</label> 
			</div>
			<?php echo $form['email'] ?>
		</div>
		<div class="row">
			<div class="label">
				<label for="user_first_name">Voornaam</label> 
			</div>
			<?php echo $form['first_name'] ?>
		</div>
		<div class="row">
			<div class="label">
				<label for="user_last_name">Achternaam</label> 
			</div>
			<?php echo $form['last_name'] ?>
		</div>
		<div class="row">
			<div class="label">
				<label for="user_birthdate">Geboortedatum</label> 
			</div>
			<?php echo $form['birthdate'] ?>
		</div>
		<?php echo $form['_csrf_token'] ?>
		<div class="row">
			<button id="submit" type="submit" >Stuur</button>
		</div>
	</div>
	
	<?php /*
	<a href="<?php echo url_for('register/index') ?>">Back to list</a>
	*/?>
	<?php if (isset($userLogged)): ?>
		<?php if (($userLogged->Permission->level > 99) OR ($userLogged->id == $form->getObject()->getId())): ?>
			<?php if (!$form->getObject()->isNew()): ?>
				<div class="delete">
					<?php echo link_to('Delete', 'register/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
</form>

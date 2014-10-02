<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Login</h1>
		</header>
		<form action="<?php echo url_for('login') ?>" method="POST" name="login" id="login">
			<?php echo $form; ?>
			<button type="submit">Login</button>
		</form>
		<?php echo $success; ?>
	</article>
</div>
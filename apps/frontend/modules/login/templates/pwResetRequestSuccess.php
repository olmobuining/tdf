<div class="page-left">
	<article class="login">
		<header>
			<h1 class="large">Reset Wachtwoord</h1>
		</header>
			<form action="<?php echo url_for('reset-request') ?>" method="POST" name="pwRequest" id="pwRequest">
				<?php echo $form; ?>
				<button type="submit">Stuur</button>
			</form>
		<p class="error"><?php echo $error; ?></p>
	</article>
</div>
<aside class="text">
	<article>
		<header>
			<h2 class="ringbearer">Informatie</h2>
		</header>
		<p>Na het invullen van je email druk je op de knop "Stuur" en word er een email verstuurd met instructies.</p>
	</article>
</aside>
<script>
<?php 
if(isset($disableLogin)) {
	if($disableLogin === true) {
		?>
		$(document).ready(function() {
			$('button').hide();	
		});
		
		<?php
	}
}
?>
</script>
<div class="page-left">
	<article class="login">
		<header>
			<h1 class="large">Login</h1>
		</header>
		<?php if(isset($isLoggedIn)):?>
			<p>Welkom terug, <?php echo $user->username; ?>, als u dit niet bent, <a href="<?php echo url_for('logout'); ?>">Klik hier om uit te loggen!</a></p>
		<?php else: ?>
			<form action="<?php echo url_for('login').'?url='.urlencode($url); ?>" method="POST" name="login" id="login">
			<form action="<?php echo url_for('login').'?url='.urlencode($url); ?>" method="POST" name="login" id="login">
				<?php echo $form; ?>
				<button type="submit">Login</button>
			</form>
		<?php endif; ?>
		<p class="error"><?php echo $error; ?></p>
	</article>
</div>
<aside class="text">
	<article>
		<header>
			<h2 class="ringbearer">Informatie</h2>
		</header>
		<p>Heeft u nog geen account, registreer dan <a href="<?php echo url_for('register'); ?>">hier</a>. Als uw account nog niet geactiveerd is, log dan niet in en wacht tot uw account is geactiveerd. </p>
		<p><strong>Wachtwoord kwijt?</strong> <a href="<?php echo url_for('reset-request'); ?>">Klik hier</a> om een nieuw wachtwoord aan te maken.</p>
	</article>
</aside>
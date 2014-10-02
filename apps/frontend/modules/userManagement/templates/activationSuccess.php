<div class="page-left">
	<article class="form">
		<header>
				<h1 class="large">Account activeren</h1>
		</header>
		<p>Selecteer je voorkeur om je account te activeren voor 30 dagen.</p>
		<form action="" method="post" name="preferRank" id="preferRank">
		<div class="form">
			<div class="row">
				<div class="label">
					<?php echo $form['rank']->renderLabel(); ?>
				</div>
				<?php echo $form['rank'] ?>
				<?php echo $form['rank']->renderError(); ?>
				<?php echo $form['_csrf_token'] ?>
			</div>
			<div class="row">
				<button type="submit">activeren</button>
			</div>
		</div>
		</form>
	</article>
</div>
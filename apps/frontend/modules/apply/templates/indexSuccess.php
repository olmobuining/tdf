<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('apply'); ?>">Aanmelden</a>
</div>
<div class="page-left">
	<article class="apply">
		<header>
			<h1 class="large">Aanmelden</h1>
		</header>
		<?php if(isset($isLoggedIn)):?>
			<p>Welkom terug, <?php echo $user->username; ?>, ben jij dit niet? <a href="<?php echo url_for('logout'); ?>">Klik dan hier om uit te loggen!</a></p>
		<?php else: ?>
			<form action="<?php echo url_for('apply') ?>" method="POST" name="apply" id="apply">		
				<div class="apply">
					<div class="row">
						<div class="label">
							<label for="apply_name">Volledige naam</label> 
						</div>
						<?php echo $form['name'] ?>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_email">Email</label> 
						</div>
						<?php echo $form['email'] ?>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_age">Leeftijd</label> 
						</div>
						<?php echo $form['age'] ?>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_char_name">Character naam</label>
						</div>
						<?php echo $form['char_name'] ?>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_char_race">Ras</label> 
						</div>
						<?php echo $form['char_race'] ?><br>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_char_profession">Profession</label> 
						</div>
						<?php echo $form['char_profession'] ?>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_preference">Voorkeur</label> 
						</div>
						<?php echo $form['preference'] ?>
					</div>
					<div class="row">
						<div class="label">
							<label for="apply_extra">Extra informatie</label> 
						</div>
						<?php echo $form['extra'] ?>
					</div>
					<?php echo $form['_csrf_token']->render(); ?>
				</div>
				<button type="submit">Stuur</button>
			</form>
		<?php endif; ?>
	</article>
</div>
<aside class="text">
	<article>
		<header>
			<h2 class="ringbearer">Fout meldingen</h2>
		</header>
		<p>Wanneer er foutmeldingen of andere meldingen zijn,<br>
		zullen deze hier verschijnen:</p>
		<div class="errorsForm">
			<p><?php echo $message; ?></p>
			<ul>
			  <?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
				<?php if($form[$widgetName]->hasError()): ?>
				<li><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError(); ?></li>
				<?php endif; ?>
			  <?php endforeach;?>
			</ul>
		</div>
		<br>
		<br>
		<p>Na het aanmelden ontvangt u een email als bevestiging dat u interesse heeft om zich bij The Dutch Fellowship aan te sluiten.</p><br>
		<p>Wanneer u geen email ontvangt:</p>
		<p>Controleer of u het juiste emailadres heeft ingevuld en/of alle velden zijn ingevuld.  <br>
		Blijft u problemen houden kunt u ons mailen:  info@guild-tdf.nl of ingame contact met ons opnemen.</p><br>
		<p>Na het beoordelen van uw aanmelding nemen wij contact met u op.</p>
	</article>
</aside>
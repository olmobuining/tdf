<script>
	$(function() {
		$( "#apply_date_of_birth" ).datepicker({
			dateFormat: 'dd-mm-yy',
			minDate: '-80y',
			maxDate: '-14y',
			changeMonth: true,
			changeYear: true,
			yearRange: '1940:1999'
			
		});
	});
</script>
<article class="full-page apply">
	<header>
		<h1 class="ringbearer">Aanmeldingsformulier</h1>
	</header>
	<form action="<?php echo url_for('apply') ?>" method="POST" name="apply" id="apply">
		<section>
			<header>
				<h4 class="ringbearer">Over jou</h4>
			</header>
			<div class="field">
				<?php echo $form['firstname']->renderLabel(); ?>
				<?php if($form['firstname']->hasError()): ?>
					<span><?php echo $form['firstname']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['firstname'] ?>
				
			</div>
			<div class="field">
				<?php echo $form['surname']->renderLabel(); ?>
				<?php if($form['surname']->hasError()): ?>
					<span><?php echo $form['surname']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['surname'] ?>
			</div>
			<div class="field">
				<?php echo $form['date_of_birth']->renderLabel(); ?>
				<?php if($form['date_of_birth']->hasError()): ?>
					<span><?php echo $form['date_of_birth']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['date_of_birth'] ?>
			</div>
			<div class="field">
				<?php echo $form['gender']->renderLabel(); ?>
				<?php if($form['gender']->hasError()): ?>
					<span><?php echo $form['gender']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['gender'] ?>
			</div>
			<div class="field">
				<?php echo $form['countries']->renderLabel(); ?>
				<?php if($form['countries']->hasError()): ?>
					<span><?php echo $form['countries']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['countries'] ?>
			</div>
			<div class="field">
				<?php echo $form['playStyle']->renderLabel(); ?>
				<?php if($form['playStyle']->hasError()): ?>
					<span><?php echo $form['playStyle']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['playStyle'] ?>
			</div>
			<div class="field">
				<?php echo $form['ts3']->renderLabel(); ?>
				<?php if($form['ts3']->hasError()): ?>
					<span><?php echo $form['ts3']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['ts3'] ?>
			</div>
			<div class="field">
				<?php echo $form['mic']->renderLabel(); ?>
				<?php if($form['mic']->hasError()): ?>
					<span><?php echo $form['mic']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['mic'] ?>
			</div>
			<div class="field">
				<?php echo $form['preference']->renderLabel(); ?>
				<?php if($form['preference']->hasError()): ?>
					<span><?php echo $form['preference']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['preference'] ?>
			</div>
			<div class="field">
				<?php echo $form['source']->renderLabel(); ?>
				<?php if($form['source']->hasError()): ?>
					<span><?php echo $form['source']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['source'] ?>
			</div>
			<div class="field">
				<?php echo $form['source_explanation']->renderLabel(); ?>
				<?php if($form['source_explanation']->hasError()): ?>
					<span><?php echo $form['source_explanation']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['source_explanation'] ?>
			</div>
			<div class="field">
				<?php echo $form['motivation']->renderLabel(); ?>
				<p>
					Het accepteren van nieuwe leden is strenger geworden. Daarom kijken wij strenger naar je motivatie.
				</p>
				<?php if($form['motivation']->hasError()): ?>
					<span><?php echo $form['motivation']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['motivation'] ?>
			</div>
			<div class="field">
				<?php echo $form['otherguild']->renderLabel(); ?>
				<?php if($form['otherguild']->hasError()): ?>
					<span><?php echo $form['otherguild']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['otherguild'] ?>
			</div>
			<div class="field">
				<?php echo $form['guilds']->renderLabel(); ?>
				<?php if($form['guilds']->hasError()): ?>
					<span><?php echo $form['guilds']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['guilds'] ?>
			</div>
		</section>
		<section>
			<header>
				<h4 class="ringbearer">Je main karakter</h4>
			</header>
			<div class="field">
				<?php echo $form['char_name']->renderLabel(); ?>
				<?php if($form['char_name']->hasError()): ?>
					<span><?php echo $form['char_name']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['char_name'] ?>
			</div>
			<div class="field">
				<?php echo $form['char_level']->renderLabel(); ?>
				<?php if($form['char_level']->hasError()): ?>
					<span><?php echo $form['char_level']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['char_level'] ?>
			</div>
			<div class="field">
				<?php echo $form['char_race']->renderLabel(); ?>
				<?php if($form['char_race']->hasError()): ?>
					<span><?php echo $form['char_race']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['char_race'] ?>
			</div>
			<div class="field">
				<?php echo $form['char_profession']->renderLabel(); ?>
				<?php if($form['char_profession']->hasError()): ?>
					<span><?php echo $form['char_profession']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['char_profession'] ?>
			</div>
		</section>
		<section>
			<header>
				<h4 class="ringbearer">Voor je account</h4>
			</header>
			<p>Na het versturen van je aanmeldingsformulier zal er gelijk een account worden aangemaakt op de website en ons forum. Vandaar dat wij vragen alvast gegevens voor je account in te vullen. <br>(Dit wordt automatisch gedaan, geen van de admins kan jouw wachtwoord achterhalen)</p>
			<div class="field">
				<?php echo $form['username']->renderLabel(); ?>
				<p>
					Gebruik hier je naam van je Guild Wars 2 account zonder de cijfers ( zoals Jan ( ingame is het Jan.1234 ). Gebruik niet je karakter naam! ) 
				</p>
				<?php if($form['username']->hasError()): ?>
					<span><?php echo $form['username']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['username'] ?>
			</div>
			<div class="field">
				<?php echo $form['password']->renderLabel(); ?>
				<?php if($form['password']->hasError()): ?>
					<span><?php echo $form['password']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['password'] ?>
			</div>
			<div class="field">
				<?php echo $form['password2']->renderLabel(); ?>
				<?php if($form['password2']->hasError()): ?>
					<span><?php echo $form['password2']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['password2'] ?>
				<?php echo $form['_csrf_token']->render(); ?>
				<span><?php echo $passwordCheck; ?></span>
			</div>
			<div class="field">
				<?php echo $form['email']->renderLabel(); ?>
				<?php if($form['email']->hasError()): ?>
					<span><?php echo $form['email']->getError();?></span>
				<?php endif; ?>
				<?php echo $form['email'] ?>
			</div>
		</section>
		<button>
			Verstuur je aameldings formulier
		</button>
	</form>
</article>
<br>
<br>
<br>
<br>
<br>
<?php //echo $form; ?>
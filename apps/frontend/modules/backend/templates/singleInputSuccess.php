<div class="page-left">
	<article class="form">
		<header>
				<h1 class="large"><?php echo $name; ?> <?php echo $editOrNew; ?></h1>
		</header>
		<?php if ($what == 'username'): ?>
			<p>Graag alleen je gebruikersnaam veranderen als het niet overeen komt met je gebruikersnaam in Guild Wars 2. <br><br>
			
			Bijvoorbeeld: is je gebruikersnaam ingame: "Jan"  ( Let op! de naam zonder .1234 erachter )<br><br></p>
		<?php endif; ?>
		<form action="<?php echo url_for('change', array('what' => $what, 'id' => $id)); ?>" method="post" name="singleInput" id="singleInput">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="singleInput"><?php echo $name; ?></label> 
				</div>
				<?php echo $form['singleInput'] ?>
				<?php echo $form['_csrf_token'] ?>
			</div>
			<div class="row">
				<?php echo $message; ?>
			</div>
			<div class="row">
				<button type="submit">Opslaan</button>
			</div>
		</div>
		</form>
	</article>

</div>
<aside class="text">
	<header>
		<h2 class="ringbearer">Foutmeldingen</h2>
	</header>
	<ul>
		<?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
			<?php if($form[$widgetName]->hasError()): ?>
				<li><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError(); ?></li>
			<?php endif; ?>
		<?php endforeach;?>
	</ul>
</aside>

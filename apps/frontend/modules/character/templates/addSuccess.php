<form action="<?php echo url_for('addcharacter'); ?>" method="post" id="character" name="character">
<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Karakter toevoegen</h1>
		</header>
		
		<div class="form">
			<div class="row">
				<div class="label">
					Naam
				</div>
				<?php echo $form['name'] ?>
			</div>
			<div class="row">
				<div class="label">
					Level
				</div>
				<?php echo $form['level'] ?>
			</div>
			<div class="row">
				<div class="label">
					Main
				</div>
				<?php echo $form['main'] ?>
			</div>
			<div class="row">
				<div class="label">
					Ras
				</div>
				<?php echo $form['race'] ?>
			</div>
			<div class="row">
				<div class="label">
					Profession
				</div>
				<?php echo $form['profession'] ?>
			</div>
			<div class="row">
				<div class="label">
					Beroep 1
				</div>
				<?php echo $form['craft1'] ?>
			</div>
			<div class="row">
				<div class="label">
					Beroep 2
				</div>
				<?php echo $form['craft2'] ?>
				<?php echo $form['_csrf_token'] ?>
			</div>
			<div class="row">
				<button id="submit" type="submit" >Stuur</button>
			</div>
		</div>
	</article>
</div>
</form>

<aside class="text">
	<article>
		<header>
			<h2 class="ringbearer">Foutmeldingen</h2>
		</header>
		<p></p>
	</article>
	<section class="errors">
		<ul>
			<?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
				<?php if($form[$widgetName]->hasError()): ?>
					<li><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError(); ?></li>
				<?php endif; ?>
			<?php endforeach;?>
		</ul>
		
	</section>
</aside>
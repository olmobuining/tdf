<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Tag toevoegen</h1>
		</header>
		<form action="<?php echo url_for('new-tag'); ?>" method="post" name="addTag" id="addTag">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="addTag_tag">Naam</label> 
				</div>
				<?php echo $form['tag'] ?>
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

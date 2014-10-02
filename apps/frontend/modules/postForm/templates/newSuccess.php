<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Blog plaatsen</h1>
		</header>
		<?php include_partial('form', array('form' => $form, 'type' => $type)) ?>
	</article>
</div>
<aside class="text">
	<header>
		<h2 class="ringbearer">Links</h2>
	</header>
	<p><a href="<?php echo url_for('my_account'); ?>">Mijn pagina</a></p>
	<br>
	<p>Foutmeldingen:</p>
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
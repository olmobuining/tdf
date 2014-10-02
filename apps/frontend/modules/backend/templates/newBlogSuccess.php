<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Blog plaatsen</h1>
		</header>
		<form action="<?php echo url_for('post-blog', array('type' => $type)) ?>" method="post" name="post" id="post">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="post_title">Titel</label> 
				</div>
				<?php echo $form['title'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="post_text">Tekst</label> 
				</div>
				<?php echo $form['text'] ?>
			</div>
			<div class="row">
				<button type="submit">Post</button>
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

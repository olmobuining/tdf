<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Nieuw plaatje</h1>
		</header>
		<?php echo form_tag('@new-image', 'multipart=true id=imageUpload') ?>
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
				<div class="label">
					<label for="post_text">Plaatje</label> 
				</div>
				<?php echo $form['file'] ?>
			</div>
			<div class="row">
				<button type="submit">Post</button>
				<?php echo $form['_csrf_token']->render(); ?>
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
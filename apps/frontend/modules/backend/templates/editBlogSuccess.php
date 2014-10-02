<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,|,cut,copy,paste,|,bullist,numlist,|,outdent,indent",
        theme_advanced_buttons2 : "undo,redo,|,link,unlink,|,removeformat,|,sub,sup,|,charmap,emotions",
        theme_advanced_buttons3 : "",      
        theme_advanced_toolbar_location : "bottom",
        theme_advanced_toolbar_align : "left",
        theme_advanced_resizing : false
	});
</script>
<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Blog plaatsen</h1>
		</header>
		<form action="<?php echo url_for('edit-blog', array('id' => $blog->id)) ?>" method="post" name="Post" id="post">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="post_title">Titel</label> 
				</div>
				<?php echo $form['title'] ?>
				<?php echo $form['_csrf_token'] ?>
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

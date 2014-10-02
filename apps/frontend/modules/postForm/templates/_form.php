<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
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
<form action="<?php echo url_for('postForm/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>/type/<?php echo $type ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="post" name="post">
	<?php if (!$form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
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
			<br style="clear:both;">
			<?php echo $form['text'] ?>
		</div>
		<?php echo $form['_csrf_token'] ?>
		<div class="row">
			<button type="submit">Post</button>
		</div>
	</div>
	<?php /****    <input type="submit" value="Save" />    ****/ ?>
</form>

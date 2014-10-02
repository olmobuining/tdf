<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Nieuw Evenement</h1>
		</header>
		<div class="form">
		<form method="post" action="<?php echo url_for('new-public-event'); ?>" id="public_event" name="public_event">
			<div class="row">
				<div class="label">
					<label for="event_title">Titel</label> 
				</div>
				<?php echo $form['title'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_text">Tekst</label> 
				</div>
				<?php echo $form['text'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_">Datum</label>
				</div>
				<?php echo $form['date'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_">Start tijd</label> 
				</div>
				<?php echo $form['hour'] ?><?php echo $form['minutes'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_pre">Verzameltijd voor start tijd.</label>
				</div>
				<?php echo $form['pre'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_end">Duur*<br><span>*Uren/minuten vanaf start</span></label>
				</div>
				<?php echo $form['end'] ?>
			</div>
			<div class="clear"></div>
			<br><br><br><br>
			
			<div class="row">
				<div class="label">
					<label for="event_max_characters">Maximaal aantal deelnemers</label> 
				</div>
				<?php echo $form['max_characters'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_level_requirement">Minimaal level</label>
				</div>
				<?php echo $form['level_requirement'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_approval"> Toestemming nodig om te kunnen deelnemen</label>
				</div>
				<?php echo $form['approval'] ?>
				<?php echo $form['_csrf_token'] ?>
			</div>
			<div class="row">
				<button type="submit">Post</button>
			</div>
		</form>
		</div>
	</article>
	<script>
	$(function () {
		$( "#public_event_date" ).datepicker({
			dateFormat: 'dd-mm-yy',
			minDate: '0d',
			maxDate: '+5months',
			changeMonth: true
			});
	});
	</script>
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
<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Nieuw Event</h1>
		</header>
		<div class="form">
		<form method="post" action="<?php echo url_for('edit-event', array('id' => $event->id)); ?>" id="event" name="event">
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
					<label for="event_">Dag</label> bv: 1
				</div>
				<?php echo $form['day'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_">month</label> bv: 5
				</div>
				<?php echo $form['month'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_">year</label> bv: 2012
				</div>
				<?php echo $form['year'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_">hour</label> bv: 22
				</div>
				<?php echo $form['hour'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_">minutes</label> bv: 45
				</div>
				<?php echo $form['minutes'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_max_characters">max_characters</label> 
				</div>
				<?php echo $form['max_characters'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_level_requirement">level_requirement</label> max 80
				</div>
				<?php echo $form['level_requirement'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_pre">pre</label> In minuten
				</div>
				<?php echo $form['pre'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_end">end</label> In minuten
				</div>
				<?php echo $form['end'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_points">points</label> 
				</div>
				<?php echo $form['points'] ?>
			</div>
			<div class="row">
				<div class="label">
					<label for="event_approval">approval</label> Toestemming nodig om te kunnen deelnemen
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
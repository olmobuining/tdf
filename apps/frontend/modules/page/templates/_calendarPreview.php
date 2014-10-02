<article class="char-logs">
	<header>
		<h2 class="ringbearer">Volgende Evenementen</h2>
	</header>
	<?php if(count($events) == 0): ?>
		<p>Er zijn geen evenementen gepland.</p>
	<?php else: ?>
		<?php foreach($events as $event): ?>
		<div class="CharLogItem">
			<a href="<?php echo url_for('event', array('slug' => $event->slug)); ?>"><?php echo $event->name.' ('.count($event->getAllSignups()).')</a><span>'.strftime('%a %e %b %H:%M',$event->start)."</span>"; ?></a>
		</div>
		<?php endforeach; ?>
	<?php endif; ?>
</article>
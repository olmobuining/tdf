<article class="char-logs">
	<header>
		<h2 class="ringbearer">Karakter log</h2>
	</header>
	<?php foreach($logs as $log): ?>
		<?php $character = Doctrine::getTable('myCharacter')->findOneById($log->mycharacter_id); ?>
		<div class="CharLogItem">
			<?php if($log->myCharacterLogType->name == 'new') : ?>
				<?php echo '<strong><a href="'. url_for("user", array("slug" => $character->User->slug)).'" title="Karakter van '. $character->User->username . '">'.$character->name. '</a> is nieuw en level ' .$log->description .'</strong><span>'.strftime('%a %e %b %H:%M',$log->created_at)."</span>"; ?>
			<?php elseif($log->myCharacterLogType->name == 'levelup'): ?>
				<?php echo '<strong><a href="'. url_for("user", array("slug" => $character->User->slug)).'" title="Karakter van '. $character->User->username . '">'.$character->name. '</a> is level ' .$log->description .'</strong><span>'.strftime('%a %e %b %H:%M',$log->created_at)."</span>"; ?>
			<?php endif; ?>
			
		</div>
	<?php endforeach; ?>
</article>
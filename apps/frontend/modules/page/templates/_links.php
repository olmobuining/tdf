<ul>
	<?php if($userLogged): ?>
		<li><a href="<?php echo url_for('guild_roster'); ?>">Guild roster</a></li>
	<?php else: ?>
		<li><a href="http://eu.ncsoft.com/en-gb/" rel="external" target="_blank">NCSOFT</a></li>
	<?php endif; ?>
	<li><a href="http://www.arena.net/" rel="external" target="_blank">Arena Net</a></li>
	<li><a href="http://www.guildwars2.com" rel="external" target="_blank">Guild Wars 2</a></li>
	<li><a href="http://www.guildwars2guru.com/" rel="external" target="_blank">Guild Wars 2 Guru</a></li>
</ul>
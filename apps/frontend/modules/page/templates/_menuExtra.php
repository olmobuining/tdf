<li>
	<a href="Javascript:void(0)">extra</a>
	<ul>
		<?php if($userLogged): ?>
			<li><a href="<?php echo url_for('important'); ?>">Belangrijke informatie</a></li>
		<?php endif; ?>
		<li><a href="<?php echo url_for('guild_roster'); ?>">Guild roster</a></li>
		<li><a href="<?php echo url_for('about_us'); ?>">Over ons</a></li>
		<li><a href="<?php echo url_for('rules'); ?>">Regels</a></li>
		<li><a href="<?php echo url_for('donate'); ?>">Doneren</a></li>
		<?php if(!$userLogged): ?>
			<li><a href="<?php echo url_for('apply'); ?>">Aanmeldingsformulier</a></li>
		<?php endif; ?>
	</ul>
</li>
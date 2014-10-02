<article class="full-page">
	<section class="center-list">
		<header>
			<h1 class="ringbearer">Guild leiders/oprichters</h1>
		</header>
		<?php foreach($leaders as $leader): ?>
			<a href="<?php if($userIsLogged): echo url_for('user', array( 'slug' => $leader->slug)); endif; ?>"><h3 ><?php echo $leader->username; ?></h3></a>
		<?php endforeach; ?><br>
	<div class="clear"></div>
	</section>
	<section class="col">
		<header>
			<h2 class="ringbearer">PvE</h2>
		</header>
		<?php foreach($pves as $pve): ?>
			<a href="<?php if($userIsLogged): echo url_for('user', array( 'slug' => $pve->slug)); endif; ?>"><h5 <?php if ($officer = $pve->isOfficer()) { ?>class="officer"<?php } ?>><?php echo $pve->username; ?></h5></a>
		<?php endforeach; ?><br>
	</section>
	<section class="col">
		<header>
			<h2 class="ringbearer">PvX</h2>
		</header>
		<?php foreach($pvxs as $pvx): ?>
			<a href="<?php if($userIsLogged): echo url_for('user', array( 'slug' => $pvx->slug)); endif; ?>"><h5 <?php if ($officer = $pvx->isOfficer()) { ?>class="officer"<?php } ?>><?php echo $pvx->username; ?></h5></a>
		<?php endforeach; ?><br>
	</section>
	<section class="col last">
		<header>
			<h2 class="ringbearer">PvP</h2>
		</header>
		<?php foreach($pvps as $pvp): ?>
			<a href="<?php if($userIsLogged): echo url_for('user', array( 'slug' => $pvp->slug)); endif; ?>"><h5 <?php if ($officer = $pvp->isOfficer()) { ?>class="officer"<?php } ?>><?php echo $pvp->username; ?></h5></a>
		<?php endforeach; ?><br>
	</section>
	<div class="clear"></div>
	<section class="center-list">
		<header>
			<h2 class="ringbearer">WvW</h2>
		</header>
		<?php foreach($wvws as $wvw): ?>
			<a href="<?php if($userIsLogged): echo url_for('user', array( 'slug' => $wvw->slug)); endif; ?>"><h5><?php echo $wvw->username; ?></h5></a>
		<?php endforeach; ?><br>
	</section>
	<div class="clear"></div>
	<section class="center-list">
		<header>
			<h2 class="ringbearer">Stagairs</h2>
		</header>
		<?php foreach($interns as $intern): ?>
			<a href="<?php if($userIsLogged): echo url_for('user', array( 'slug' => $intern->slug)); endif; ?>"><h5><?php echo $intern->username; ?></h5></a>
		<?php endforeach; ?><br>
	</section>
	<section class="center-list">
		<p>
			Als een naam groen is, dan is hij/zij een officer zoals:
			<span class="officer">Guild Officer</span>
		</p>
	</section>
	
</article>
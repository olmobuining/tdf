<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('gallery'); ?>">Galerie</a> &raquo;
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Galerie</h1>
		</header>
		<p>Op deze pagina vind u alle albums op de website. Klik op een van de albums om de plaatjes te bekijken.</p>
	</article>
	<article class="albums">
		<header>
			<h2 class="ringbearer">Albums</h2>
		</header>
		<?php $isOdd = array('', 'odd'); ?>
		<?php $i=0; ?>
		<?php foreach ($albums as $album): ?>
			<a href="<?php echo url_for('album', array('slug' => $album->slug)); ?>">
			<section class="album <?php echo $isOdd[$i++%2]; ?>">
				<header>
					<p><?php echo $album->name; ?></p>
				</header>
				<figure>
					<?php foreach ($album->Images as $image): ?>
						<img src="/uploads/images/<?php echo $image->folder; ?>/large/<?php echo $image->src; ?>"/>
					<?php break; endforeach; ?>
				</figure>
			</section>
			</a>
		<?php endforeach; ?>
	</article>
</div>
<aside>
	<?php include_component('page', 'randomImage'); ?>
</aside>
<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('gallery'); ?>">Galerie</a> &raquo;
	<a href="<?php echo url_for('album', array('slug' => $album->slug)); ?>">Album: <?php echo $album->name ?></a> 
</div>
<article class="album-full">
	<header>
		<h1 class="large">Album: <?php echo $album->name; ?></h1>
	</header>
	<?php $isOdd = array('', '', 'odd'); ?>
	<?php $i=0; ?>
	<?php foreach ($images as $image): ?>
		<a href="<?php echo url_for('image', array('type' => 'album', 'type_slug' => $album->slug, 'image_slug' => $image->slug)); ?>">
		<section class="image <?php echo $isOdd[$i++%3]; ?>">
			<header>
				<p><?php echo $image->title; ?></p>
			</header>
			<figure>
					<img src="/uploads/images/<?php echo $image->folder; ?>/medium/<?php echo $image->src; ?>"/>
			</figure>
		</section>
		</a>
		<?php 
		if ($i == 3 ) {
			echo "<div class=\"clear\"></div>";
			$i=0;	
		}
		
		?>
	<?php endforeach; ?>
</article>
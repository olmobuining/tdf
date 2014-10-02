<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('tag', array('slug' => $tag->slug)); ?>">Tag: <?php echo $tag->name; ?></a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Tag: <?php echo $tag->name; ?></h1>
			<h2 class="ringbearer">Blogs</h2>
		</header>
		
		<?php 
			if (count($relatedBlogs) == 0) {
				?>
				<p>Er zijn geen plaatjes met deze tag.</p>
				<?php	
			}
		?>
		<?php foreach ($relatedBlogs as $blog): ?>
			<section class="short-blog">
				<header>
					<h2><?php echo $blog->title; ?></h2>
					<div class="sub-text">
						<?php echo date('j-m-Y H:i:s', $blog->created_at). ' door '. $blog->User->username; ?>
					</div>
				</header>
				<?php $text = html_entity_decode($blog->text); ?>
				<?php 
					if (strpos($text, '</p>') !== false) {
						echo substr($text, 0, strpos($text, '</p>'));
					} else {
						echo substr($text, 0, 360);
					}
				?>
				<div class="read-more">
					<a href="<?php echo url_for('blog_item', array('type' => $blog->PostType->slug, 'slug' => $blog->slug)); ?>" class="read-more">Lees meer</a>
				</div>
			</section>
		<?php endforeach; ?>
	</article>
</div>
<aside>
	<article class="random-image">
		<header>
			<h2 class="ringbearer">Plaatjes</h2>
		</header>
		<?php 
			if (count($relatedImages) == 0) {
				?>
				<p>Er zijn geen plaatjes met deze tag.</p>
				<?php	
			}
		?>
		<?php foreach ($relatedImages as $image): ?>
		<?php 
			if (count($image->Albums) == 0 ) {
				$albumName = 'no-album';	
			} else {
				foreach ($image->Albums as $album) {
					$albumName = $album->slug;	
				}
			}
		?>
			<figure>
				<a href="<?php echo url_for('image', array('type' => 'album', 'type_slug' => $albumName, 'image_slug' => $image->slug)) ?>"><img src="/uploads/images/<?php echo $image->folder.'/large/'.$image->src; ?>"></a>
			</figure>
		<?php endforeach; ?>
	</article>
</aside>
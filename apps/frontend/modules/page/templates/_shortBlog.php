<article class="main">
	<header>
		<h1 class="large">Nieuws blog</h1>
	</header>
	<?php foreach ($recentBlogs as $blog): ?>
		<section class="short-blog">
			<header>
				<h2><?php echo $blog->title; ?></h2>
				<div class="sub-text">
					<?php echo strftime('%c', $blog->created_at). ' door '. $blog->User->username; ?>
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
			<?php  ?>
			<div class="read-more">
				<a href="<?php echo url_for('blog_item', array('type' => $blog->PostType->slug, 'slug' => $blog->slug)); ?>" class="read-more">Lees meer</a>
			</div>
		</section>
	<?php endforeach; ?>
</article>

<a href="<?php echo url_for('blog_item', array('type' => $blog->PostType->slug, 'slug' => $blog->slug)); ?>">
	<article class="sub">
		<header>
			<h3><?php echo $blog->title; ?></h3>
		</header>
		<p><?php echo substr(html_entity_decode(strip_tags($blog->text)),0, 140); ?>.. Lees verder....</p>
	</article>
</a>
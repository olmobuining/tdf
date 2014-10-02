<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('blog', array('type' => $postType->slug)); ?>"><?php echo $postType->name; ?> Blog</a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large"><?php echo $postType->name; ?> blog</h1>
		</header>
		<?php foreach ($blogs as $blog): ?>
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
				<div class="read-more">
					<a href="<?php echo url_for('blog_item', array('type' => $blog->PostType->slug, 'slug' => $blog->slug)); ?>" class="read-more">Lees meer</a>
				</div>
			</section>
		<?php endforeach; ?>
		
		<?php if ($prev) : ?>
			<section class="prev">
				<a href="<?php echo url_for('blogpage', array('type' => $type, 'page' => ($page - 1))); ?>">&nbsp;</a>
			</section>
		<?php endif; ?>
		
		<?php if ($next) : ?>
			<section class="next">
				<a href="<?php echo url_for('blogpage', array('type' => $type, 'page' => ($page + 1))); ?>">&nbsp;</a>
			</section>
		<?php endif; ?>
	</article>
</div>
<aside class="tags">
	<article>
		<header>
			<h2 class="ringbearer">Tags</h2>
		</header>
		<p>
		<?php foreach ($tags as $tag) : ?>
			<?php 
				switch ($tag['count']) {
					case 1:
					default:
						$size = 11;
						$bold = '100'; 
						break;
					case 2:
						$size = 12;
						$bold = '300';
						break;
					case 3:
						$size = 13;
						$bold = '400';
						break;
					case 4:
						$size = 14;
						$bold = '500';
						break;	
					case 5:
						$size = 15;
						$bold = '600';
						break;
					case 6:
						$size = 16;
						$bold = '700';
						break;
					case 7:
						$size = 17;
						$bold = '800';
						break;
					case 8:
						$size = 18;
						$bold = '900';
						break;
					case 9:
						$size = 19;
						$bold = 'bolder';
						break;
					case 10:
						$size = 20;
						$bold = 'bold';
						break;
					case ($tag['count'] > 10):
						$size = 21;
						$bold = 'bolder';
						break;
					case ($tag['count'] > 20):
						$size = 24;
						$bold = 'bolder';
						break;
				}
				echo '<a href="'.url_for('tag', array('slug' => $tag['tag']->slug)).'" class="tag"><span style="font-size:'.$size.'px; font-weight:'.$bold.'">'.$tag['tag']->name.'</span></a>';
			?>
		<?php endforeach; ?>
		</p>
	</article>
</aside>
<aside>
	<?php if($userLogged): ?>
		<?php if($userLogged->Permission->level > $charLogReq): ?>
			<?php include_component('page', 'charLog'); ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php include_component('page', 'randomImage'); ?>
</aside>

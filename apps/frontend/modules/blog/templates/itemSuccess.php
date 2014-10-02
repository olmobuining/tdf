<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('blog', array('type' => $type));; ?>">Nieuws Blog</a> &raquo;
	<a href="<?php echo url_for('blog_item', array('type' => $type, 'slug' => $blog->slug)); ?>"><?php echo $blog->title; ?></a> 
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large"><?php echo $blog->title; ?></h1>
			<?php if (count($subImages) == 0): ?>
				<?php $h = '0px'; ?>
			<?php else: ?>
				<?php $h = 'auto'; ?>
			<?php endif; ?>
			<figure class="main-image" style="<?php if (count($mainImage) == 0) {?> height:<?php echo $h; ?>;<?php } else {?> background-image:url(/uploads/images/<?php echo $mainImage->folder. '/large/' .$mainImage->src. ');'; }?>">
			<?php if (count($subImages) != 0): ?>
				<?php $i=0; ?>
				<?php foreach ($subImages as $subImage): ?>
					<?php $i++ ?>
					<?php
					if ($i == 1) {
					?>
						<a href="<?php echo '/uploads/images/'.$subImage->folder. '/original/' .$subImage->src; ?>" rel="prettyPhoto[sub-images]" class="subPhotos" title="<?php echo $subImage->title ?>"></a>
					<?php	
					} else {
					?>
					<a href="<?php echo '/uploads/images/'.$subImage->folder. '/original/' .$subImage->src; ?>" rel="prettyPhoto[sub-images]" title="<?php echo $subImage->title ?>"></a>
				<?php  } 
					endforeach; ?>
				<?php if ((count($mainImage) > 0) && (empty($subImages[$mainImage->id])) ) {?>
					<a href="<?php echo '/uploads/images/'.$mainImage->folder. '/original/' .$mainImage->src; ?>" rel="prettyPhoto[sub-images]" class="main" ></a>
				<?php } ?>
			<?php else: ?>
				
				<?php if (count($mainImage) != 0): ?>
						<a href="<?php echo '/uploads/images/'.$mainImage->folder. '/original/' .$mainImage->src; ?>" rel="prettyPhoto[sub-images]" class="main subPhotos" ></a>
				<?php endif; ?>
			<?php endif; ?>
			</figure>
			<div class="sub-text">
				<?php echo strftime('%A %e %B %G om %X', $blog->created_at). ' door '. $blog->User->username; ?>
			</div>
		</header>
		<script type="text/javascript" charset="utf-8">
		  $(function(){
			$("a[rel^='prettyPhoto']").prettyPhoto({
				social_tools:''
				,show_title: false
				,slideshow: 2500
				});
		  });
		</script>
		<?php if($userLogged->Permission->level > sfConfig::get('app_permissions_edit_blogs')): ?>
			<a href="<?php echo url_for('edit-blog', array('id' => $blog->id)); ?>">Bewerken</a>
		<?php endif; ?>
		<?php echo html_entity_decode($blog->text); ?>
		
		<section id="social-media">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-send="false" data-layout="button_count" data-width="120" data-show-faces="false" data-font="arial"></div>
		
			<div class="g-plusone" data-annotation="none"></div>
			<script type="text/javascript">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</section>
		<section class="tags">
			<header>
				<h3>Tags</h3>
			</header>
			<p>
				<?php
					$tags = $blog->Tags;
					$countTags = count($tags);
					$i = 0;
					foreach ($tags as $tag) {
						$i++;
						echo '<a href="'.url_for('tag', array('slug' => $tag->slug)).'">'.$tag->name .'</a>';	
						if ($i != $countTags) { echo ", "; }
					}
				?>
			</p>
		</section>
		
		<section class="comments">
			<h2 class="ringbearer">Reacties</h2>
			<?php if (count($blog->Comments) == 0) : ?>
				<article class="error">
					<p>Er zijn nog geen reacties. Wees de eerste die een reactie plaatst op deze blog.</p>
				</article>
			<?php else: ?>
				<?php $i = 0; ?>
				<?php foreach($blog->Comments as $comment): ?>
					<article <?php if($i == 0) { echo 'class="first"'; } ?>>
						<header>
							<h3><?php echo $comment->User->username; ?> zegt:</h3><time><?php echo date('j-m-Y H:i:s', $comment->created_at); ?></time>
						</header>
						<p><?php echo nl2br($comment->text); ?></p>
					</article>
					<?php $i++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</section>
		<?php if(($isLoggedIn) && ($userLogged)): ?>
			<?php if ($userLogged->Permission->level >= 1) : ?>
				<?php include_component('comment', 'comment', array('blog' => $blog, 'type'=> 'post')); ?>
			<?php else: ?>
				<p>Uw account is nog niet geactiveerd.</p>
			<?php endif; ?>
		<?php else: ?>
			<p><a href="<?php echo url_for('login'); ?>">Login</a> om een reactie te plaatsen.</p>
		<?php endif; ?>
	</article>
</div>
<aside class="related">
	<header>
		<h2 class="ringbearer">Tag gerelateerde blogs</h2>
	</header>
	<?php if (count($relatedBlogs) == 0) : ?>
		<article class="error">
			<p>Er zijn nog geen tag gerelateerd blogs voor deze blog.</p>
		</article>
	<?php else: ?>
		<?php $count = 0; ?>
		<?php foreach($relatedBlogs as $related): ?>
			<?php 
			if ($count >= 5) {
				break;
			}
			?>
			<?php $count++; ?>
			<?php include_component('blog', 'relatedBlog', array('blog' => $related)); ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<br><br>
	<?php include_component('page', 'randomImage'); ?>
</aside>

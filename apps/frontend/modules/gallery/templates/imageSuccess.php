<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('gallery'); ?>">Galerie</a> &raquo;
	<?php if ($tAlbum) : ?>
		<a href="<?php echo url_for('album', array('slug' => $albumName)); ?>">Album: <?php echo $albumName ?></a> &raquo;
		<a href="<?php echo url_for('image', array('type' => 'album', 'type_slug' => $albumName, 'image_slug' => $image->slug)); ?>"><?php echo $image->title ?></a>
	<?php endif; ?>
</div>

<article class="image-full">
	<header>
		<h1 class="large"><?php echo $image->title; ?></h1>
	</header>
	<figure>
		<a href="<?php echo '/uploads/images/'.$image->folder. '/original/' .$image->src; ?>" rel="prettyPhoto[full]" class="original" ><img src="/uploads/images/<?php echo $image->folder; ?>/large/<?php echo $image->src; ?>"  /></a>
	</figure>
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
				$tags = $image->Tags;
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
		<?php if (count($image->Comments) == 0) : ?>
			<article class="error">
				<p>Er zijn nog geen reacties. Wees de eerste die een reactie plaatst!</p>
			</article>
		<?php else: ?>
			<?php $i = 0; ?>
			<?php foreach($image->Comments as $comment): ?>
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
				<?php include_component('comment', 'comment', array('blog' => $image, 'type'=> 'image')); ?>
			<?php else: ?>
				<p>Uw account is nog niet geactiveerd.</p>
			<?php endif; ?>
		<?php else: ?>
			<p><a href="<?php echo url_for('login'); ?>">Login</a> om een reactie te plaatsen</p>
		<?php endif; ?>
</article>
<aside class="image">
	<header>
		<h2 class="ringbearer">Informatie</h2>
	</header>
		<p>
			<a href="<?php echo '/uploads/images/'.$image->folder. '/original/' .$image->src; ?>" rel="prettyPhoto[image]" class="original" >Bekijk het orgineel</a><br><br>
			<strong>Geüploaded door:</strong> <?php echo $image->User->username; ?><br>
			<strong>Geüpload op:</strong> <?php echo date('d-m-Y H:i', $image->created_at); ?>
			<strong>Beschrijving:</strong> <br>
			<?php echo nl2br($image->text); ?>
		</p><br>

		<p>
			<strong>Albums met dit plaatje:</strong><br>
			<?php foreach ($image->Albums as $album): ?>
				<a href="<?php echo url_for('album', array('slug' => $album->slug)); ?>"><?php echo $album->name. '<br>'; ?></a>
			<?php endforeach; ?>
		</p>
</aside>
<script type="text/javascript" charset="utf-8">
  $(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools:''
		,show_title: false
		,slideshow: 2500
		,changepicturecallback:function () {
			_gaq.push(['_trackEvent', 'Plaatje', 'Origineel', '<?php echo $image->title; ?>']);
		}
		});
  });
</script>
<aside class="nextImage">
	<header>
		<h3 class="ringbearer">Volgend plaatje</h3>
	</header>
	<?php if (!$nextImage) : ?>
		<p>Er zijn helaas niet meer plaatjes in het album of u bent al bij het laatste plaatje in het album</p>
	<?php else: ?>
	<figure>
		<a href="<?php echo url_for('image', array('type' => 'album', 'type_slug' => $albumName, 'image_slug' => $nextImage->slug)); ?>">
		<img src="/uploads/images/<?php echo $nextImage->folder; ?>/large/<?php echo $nextImage->src ?>"/></a>
	</figure>
	<?php endif; ?>
</aside>
<br style="clear:both;">
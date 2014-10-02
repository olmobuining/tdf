
<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('donate-thanks'); ?>">Bedankt voor het doneren</a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Bedankt voor het doneren!</h1>
		</header>
		<p>De guild The Dutch Fellowship is jou erg dankbaar. Door jou kunnen wij de site onderhouden en misschien zelfs upgrades of een teamspeak/ventrillo server aanschaffen. Als je niet wilt verschijnen op de donatiepagina kun je dat melden door te emailen naar <strong>info@guild-tdf.nl</strong>.</p>
		<p>Nogmaals bedankt voor je donatie,</p>
		<p>The Dutch Fellowship Team</p>
		
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
					default:
						$size = 11;
						$bold = '100';
						break;
				}
				echo '<a href="'.url_for('tag', array('slug' => $tag['tag']->slug)).'" class="tag"><span style="font-size:'.$size.'px; font-weight:'.$bold.';">'.$tag['tag']->name.'</span></a>';
			?>
		<?php endforeach; ?>
		</p>
	</article>
</aside>
<aside>
	<?php include_component('page', 'randomImage'); ?>
</aside>
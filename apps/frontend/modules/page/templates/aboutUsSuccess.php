<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('about_us'); ?>">Over ons</a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Over The Dutch Fellowship</h1>
		</header>
		<p>
			Wij zijn een Nederlandse Guild Wars 2 guild ontstaan uit vrienden en familie. De guild bestond eerst onder de naam <strong>"Brothers of War"</strong> maar aangezien er meer dames in de guild kwamen vonden wij een verandering van de guildnaam nodig. De oom van HellHunter en K!ll0 had een guild in Guild Wars 1 genaamd <strong>The Dutch Fellowship</strong>. Na een poll op Facebook kwam die naam als meest gepast. De guild is gemaakt door 2 broers die van gamen houden.
		</p>
		<p>The Dutch Fellowship is misschien wel een Nederlandse guild, dit betekent niet dat alleen Nederlanders in de guild mogen. Dit geeft alleen aan dat wij allemaal Nederlands spreken. Ook als je niet uit de BENELUX komt ben je welkom in onze guild. Zolang je Nederlands spreekt.</p>
		<p>De guild houd zich met alle aspecten van Guild Wars 2 bezig. The Dutch Fellowship is een casual guild en omdat wij weinig van onze leden eisen, is er geen activiteits percentage nodig. Daardoor is het mogelijk om naast Guild Wars 2 een leven te hebben en toch in een guild te kunnen zitten. Ook als je veel online bent zal er genoeg te doen zijn, aangezien wij een mix hebben tussen casual en hardcore spelers.</p>
		
		<h2 class="ringbearer medium">Ons Doel</h2>
		<p>Het doel voor The Dutch Fellowship is om <strong>een gezellige</strong>, maar toch ook een goede en <strong>volwassen guild</strong> te zijn. Een groep gamers waar je graag mee samen speelt.</p>
		
		<h3 class="ringbearer medium">Communicatie</h3>
		<p>Tijdens en buiten het spelen van Guild wars 2 gebruiken wij als communicatiemiddel <strong>Teamspeak</strong>. Naast Teamspeak hebben wij ook een <strong>forum</strong>, waar onze leden kunnen discussiëren over alle ontwerpen (Ingame en Real Life). Omdat het forum niet alle functionaliteit kan bieden hebben wij ook een website met verschillende functies voor onze leden. Een <strong>kalender</strong> met alle evenementen en  de mogelijkheid om ingame karakters toevoegen aan je account, zodat je jezelf met deze karakters kunt aanmelden voor een van deze <strong>evenementen</strong>.</p>
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
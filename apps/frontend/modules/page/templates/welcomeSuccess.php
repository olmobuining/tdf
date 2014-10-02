<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('about_us'); ?>">Over ons</a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Welkom bij The Dutch Fellowship</h1>
		</header>
		<p>The Dutch Fellowship is een <strong>NL / BE guild</strong> met <strong>60+ leden</strong>. De meeste/iedereen van ons komen uit de <strong>BENELUX</strong>, ook accepteren wij mensen buiten deze regio zolang ze maar Nederlands kunnen spreken.</p>

		<p>Als guild spelen wij <strong>Guild Wars 2</strong>, en daar richten wij ons ook op. Het is natuurlijk niet verboden om andere games te spelen, maar onze website en deel van het forum is alleen gericht op Guild Wars 2. </p>
		
		<p>The Dutch Fellowship is een casual guild en vereist <strong>geen activiteits percentage</strong> van zijn leden. Naast de casual leden hebben wij ook hardcore spelers, waardoor er altijd wel iemand is om mee te spelen in de guild.</p>
		
		<p>Of wij nou heart quests, WvW, dungeons of dynamic events doen. Wij doen dit graag samen. Het is niet verplicht om met je guild leden te spelen. Je kan altijd alleen spelen als je dit wilt.</p>
		
		<p>Tijdens het spelen van Guild Wars 2, gebruiken wij Teamspeak 3 om met elkaar te communiceren. Dit is belangrijk, om toch efficient te blijven ingame. Daarom verplichten wij leden om Teamspeak 3 te installeren en onze server te joinen als er een belangrijk evenement is. Een microfoon is niet verplicht, alleen is het wel handig voor jezelf en de groep.</p>
		
		<p>Naast ons forum hebben wij ook een unieke website! Als lid van de guild bent kan je karakters aan je account koppelen en daarmee aanmelden op een evenement in de kalender.</p>
		<br>

		<h3 class="ringbearer medium"><strong>Onze recruitement staat open!</strong></h3>
		<p>Wij nemen alle Professions aan.</p>
		<br>
		<h2 class="ringbearer medium">Hoe meld ik mij aan?</h2>
		<p>Vult het formulier in op <a href="<?php echo url_for('apply'); ?>">deze pagina</a><br>
		Na het invullen van dit formulier ontvang je een mail op het ingevulde email, daarom is het belangrijk dat je een echte mail in te vullen. Als je geen mail ontvangt email dan naar info[at]guild-tdf.nl</p>
		
		<p>Je kan hierna ook alvast op de website en het forum registreren.</p>
		<p><a href="<?php echo url_for('register'); ?>" rel="internal">Hier registreer je op onze website.</a></p>
		
		<p><a href="http://forum.guild-tdf.nl" rel="sub">Hier registreer je op onze forum.</a></p>
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
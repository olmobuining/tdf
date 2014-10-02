<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('rules'); ?>">Regels</a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Regels</h1>
		</header>
		<p>The Dutch Fellowship richt zich erop om een vriendelijke en respectvolle guild te zijn. Dit verwachten wij dan ook van al onze leden. Er is op het moment een minimum leeftijd van 16 jaar ingesteld, maar alle leden moeten zich ten alle tijden volwassen gedragen ongeacht de leeftijd. Ook tolereren wij geen spam of onbeleefd/onbeschaafd taalgebruik.</p>
		<?php /*<p>Wij accepteren niet dat je nog lid bent van een andere Guild wars 2 guild. Wij vragen ook dat je minimaal 1 maal in de 3 maanden onze activiteits check uitvoert die je per mail krijgt(liefst 1 maal per maand). </p>*/?>
		<p>Enige overtreding van een van deze regels kan een waarschuwing of zelfs tot verbanning van onze guild en partners leiden.</p>
		<h2 class="ringbearer medium">Lidmaatschap</h2>
		<p>Leden van de guild zijn verplicht zich op het forum en de website te registreren. Dit om zo goed mogelijk op de hoogte te blijven van alle informatie over bijvoorbeeld de teamspeak servergegevens. Tevens is dit voor ons de eenvoudigste wijze om met onze leden in contact te blijven.</p>
		<p>Niet-leden van The Dutch Fellowship kunnen zich aanmelden voor de guild via het <a href="<?php echo url_for('apply'); ?>">Aanmeld formulier</a>. Na het beoordelen van het aanmeldformulier kunnen wij u vragen voor een kort in-game interview waarna wij een beslissing zullen nemen. <br>
Alle nieuwe leden krijgen eerst een proefperiode. Deze proefperiode is ongeveer 30 dagen. Na deze proefperiode zul je als volledig lid van de guild in een groep van je voorkeur worden ingedeeld. Aan deze voorkeur zit je niet vast en je mag altijd een andere voorkeur aangeven. Dit hoeft niet aangegeven te worden wanneer je incidenteel deze voorkeur wilt spelen. Alleen wanneer je voorkeur definitief verandert.</p>
		<h3 class="ringbearer medium">Guildranken</h3>
		<table>
			<tr>
				<td><strong>Stagair</strong></td><td>- Een nieuw lid van de guild die nog in zijn proefperiode zit;</td>
			<tr>
			</tr>
				<td><strong>PvE</strong></td> <td>- Een volledig lid van de guild met een voorkeur voor PvE;</td>
			<tr>
			</tr>
				<td><strong>PvP</strong></td> <td>- Een volledig lid van de guild met een voorkeur voor PvP;</td>
			<tr>
			</tr>
				<td><strong>WvW</strong></td> <td>- Een volledig lid van de guild met een voorkeur voor WvW;</td>
			<tr>
			</tr>
				<td><strong>PvX</strong></td> <td>- Een volledig lid van de guild met een voorkeur voor PvE en PvP;</td>
			<tr>
			</tr>
				<td><strong>Commander</strong></td> <td>- Leden die forten voor onze guild overnemen en upgrades gebruiken;</td>
			<tr>
			</tr>
				<td><strong>Officer</strong></td> <td>- Leden die helpen met de leiding van de guild, in een bepaald onderdeel of in zijn geheel;</td>
			<tr>
			</tr>
				<td><strong>Co-leider</strong></td> <td>- Mede-oprichter van de guild;</td>
			<tr>
			</tr>
				<td><strong>Leider</strong></td> <td>- Leider van de guild;</td>
			</tr>
		</table>
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
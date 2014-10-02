
<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('donate'); ?>">Doneer</a>
</div>
<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Waarom doneren?</h1>
		</header>
		<p>Als guild willen wij graag een plek hebben om dingen te bespreken en ook wel een teamspeak server. Hiervoor zullen de donaties gebruikt worden. <br>Ons <strong>eerste doel</strong> is om de <strong>kosten van de teamspeak server</strong> eruit te krijgen. Zodra dit doel bereikt is word het geld besteed aan het betalen van de kosten van de website. Het ligt er aan wat nodig is. Op deze pagina word er bijgehouden wie er gedoneerd heeft (alleen wanneer je hier toestemming voor geeft).</p>
		
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="Q5DPRXQ7F3MM4">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
		</form>
		<br>
		<table class="bw-table">
			<thead>
				<tr>
					<th>Donateur</th>
					<th>Bedrag</th>
				</tr>
			</thead>
			<tbody>
				<tr data-value="40">
					<td>Richard:</td>
					<td>&euro; 40,-</td>
				</tr>
				<tr data-value="23">
					<td>Olmo:</td>
					<td>&euro; 23,-</td>
				</tr>
				<tr data-value="23">
					<td>Petra</td>
					<td>&euro; 23,-</td>
				</tr>
				<tr data-value="18">
					<td>Mick</td>
					<td>&euro; 18,-</td>
				</tr>
				<tr data-value="15">
					<td>Lex</td>
					<td>&euro; 15,-</td>
				</tr>
				<tr data-value="15">
					<td>Ary</td>
					<td>&euro; 15,-</td>
				</tr>
				<tr data-value="12">
					<td>Onno</td>
					<td>&euro; 12,-</td>
				</tr>
				<tr data-value="12">
					<td>Max</td>
					<td>&euro; 12,-</td>
				</tr>
				<tr data-value="12">
					<td>Gina</td>
					<td>&euro; 12,-</td>
				</tr>
				<tr data-value="3.01">
					<td>Sjoerd</td>
					<td>&euro; 3,01<br>
				</tr>
				<tr data-value="173.01">
					<td><strong>Totaal</strong></td>
					<td><strong>&euro; 173,01</strong></td>
				</tr>
			</tbody>
		</table>
		<div id="gauge1" style="width:200px;height:150px; float:left;"></div>
		<div id="gauge2" style="width:200px;height:150px; float:left;"></div>
		<script>
		   
		  $(function () {
			  var g1 = new JustGage({
				id: "gauge1", 
				value: 117.41, 
				min: 0,
				max: 117.41,
				title: "2012-2013",
				label:	"euro"
			  }); 
			  var g2 = new JustGage({
				id: "gauge2", 
				value: 55.6, 
				min: 0,
				max: 104.6,
				title: "2013-2014",
				label:	"euro"
			  });
			$('tbody tr').mouseover(function () {
				var amount = $(this).attr('data-value');
				g2.refresh(amount);
				$('div#gauge2 text:first > tspan').text($(this).text());
			});
			$('tbody tr').mouseout(function () {
				g2.refresh(55.6);
				
				$('div#gauge2 text:first > tspan').text('2013-2014');
			});
		  });
		</script>
		<br style="clear:both;">
		<br>
		<p>Dankzij onze geweldige donateurs zijn de kosten voor de teamspeak server en de webserver voor dit jaar(juli 2012 - juli 2013) betaald! Toch kunnen wij altijd nog donaties gebruiken voor een PvP arena!(zodra deze gereleased is)</p>
		<?php /* <img src="/images/donations1.jpg" /> */ ?>
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
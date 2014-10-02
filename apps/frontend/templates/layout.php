<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  	
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
	<?php include_slot('socialmediaHeader'); ?>
    <script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-30158941-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
  </head>
  <body>
  <?php /*
	<script>
	var isMSIE = /*@cc_on!@*//*0;

	if (isMSIE) {
	  $('#ie-alert').show();
	} else {
		$('#ie-alert').hide();
	}
	</script>
	*/?>
	<?php $em = $sf_user->getAttribute('errorMessage') ?>
	<?php $eventPush = $sf_user->getAttribute('pushEvent') ?>
	<?php if(!empty($eventPush)): ?>
		<script>
			$(function () {
				<?php if(!isset($eventPush[3])): ?>
					_gaq.push(['_trackEvent', '<?php echo $eventPush[0] ?>', '<?php echo $eventPush[1] ?>', '<?php echo $eventPush[2] ?>']);
				<?php else: ?>
					_gaq.push(['_trackEvent', '<?php echo $eventPush[0] ?>', '<?php echo $eventPush[1] ?>', '<?php echo $eventPush[2] ?>', '<?php echo $eventPush[3] ?>']);
				<?php endif; ?>
			});
		</script>
	<?php $sf_user->setAttribute('pushEvent', ''); endif; ?>
	<?php if(!empty($em)): ?>
		<script>
		 $(function () {
			
			 var emd =  $('div#errorMessage');
			 emd.css({ 'left':window.innerWidth / 2 - (emd.width() / 2) , 'top': window.innerHeight / 2 -( emd.height() / 2 ) });
			 emd.fadeOut(0).fadeIn(500);
			// var t = setTimeout(function () {emd.fadeOut(500);}, 3000);
			 $('html').click(function() {
			 	var t = setTimeout(function () {emd.fadeOut(500);}, 250);
			 });
		 });
		
		</script>
		<div id="errorMessage"><?php echo html_entity_decode($sf_user->getAttribute('errorMessage')); ?><br><br><span class="small-info">Klik ergens om dit te sluiten.</span></div>
	<?php 
		$sf_user->setAttribute('errorMessage', '');
		endif;
	?>
	<div id="loginContainer">
		<div id="login">
			<?php include_component('login', 'layoutLogin'); ?>
		</div>
	</div>
  	<div id="wrapper">
		<div id="container">
			<header class="nav">
				<div id="logo">
					<a href="<?php echo url_for('homepage'); ?>"><img src="/images/logo.jpg"></a>
				</div>
				<nav>
					<ul>
						<li><a href="<?php echo url_for('homepage'); ?>">home</a></li>
						<li><a href="http://forum.guild-tdf.nl/">forum</a></li>
						<li><a href="<?php echo url_for('blog', array('type' => 'news')); ?>">nieuws</a></li>
						<li><a href="<?php echo url_for('gallery'); ?>">galerie</a></li>
						<?php include_component('page', 'menuExtra'); ?>
						
					</ul>
				</nav>
			</header>
			<div id="content">
				<?php echo $sf_content ?>
			</div>
			<footer>
				<a href="http://www.arena.net/" rel="external" target="_blank"><img src="/images/arenanetlogo.jpg"></a>
				<a href="http://www.guildwars2.com" rel="external" target="_blank"><img src="/images/guildwarslogo.jpg"></a>
				<ul>
					<li><a href="<?php echo url_for('homepage'); ?>">Home</a></li>
					<li><a href="http://www.dutchfellowship.nl/">Forum</a></li>
					<li><a href="<?php echo url_for('donate'); ?>">Doneren</a></li>
					<li><a href="<?php echo url_for('apply'); ?>">Aanmeldingsformulier</a></li>
				</ul>
				
				<ul>
					<li><a href="<?php echo url_for('about_us'); ?>">Over ons</a></li>
					<li><a href="<?php echo url_for('rules'); ?>">Regels</a></li>
					<li><a href="<?php echo url_for('blog', array('type' => 'news')); ?>">Nieuws</a></li>
					<li><a href="<?php echo url_for('login'); ?>">Login</a></li>
				</ul>
				<?php include_component('page', 'links'); ?>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="http://static-ascalon.cursecdn.com/current/js/syndication/tt.js"></script>
  </body>
</html>

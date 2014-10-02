<header id="index-header">
	<?php /* 
	<div class="countdown-timer">
		<div class="information-t">Aftellen tot de headstart</div>
		<div class="information-d">dagen</div>
		<div class="information-h">uren</div>
		<div class="information-m">minuten</div>
		<div class="information-s">seconden</div>
		<div class="days" style="padding:0 20px 0 0 ; float:left;">-</div>
		<div class="hours" style="float:left;">-</div>
		<div class="minutes" style="float:left;">-</div>
		<div class="seconds" style="float:left;">-</div>
	</div>
	*/?>
	<article id="slide-holder" >
		<div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
				<a href="http://guild-tdf.nl/gallery/album/wvw-album"><img src="/images/slider/wvwalbum.jpg" alt="World vs World screenshots" /></a>
				<a href="http://guild-tdf.nl/gallery/album/wvw-album"><img src="/images/slider/wvwalbum2.jpg" alt="World vs World screenshots" /></a>
            </div>
        </div>
	</article>
	<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
			controlNav: false,
			effect:'fade'
		});
    });
    </script>
</header>
<div class="page-left">
	<?php include_component('page', 'shortBlog'); ?>
</div>
<aside>
	<a href="<?php echo url_for('blog', array('type' => 'beginners')); ?>"><img src="/images/bbbutton.jpg"  /></a>
	<?php if($userLogged): ?>
		<?php if($userLogged->Permission->level > $charLogReq): ?>
			<?php include_component('page', 'calendarPreview'); ?>
			<?php include_component('page', 'charLog'); ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php include_component('page', 'randomImage'); ?>
</aside>
<?php /* 
<script>
	var day 	= 	1000*60*60*24;
	var hour 	= 	1000*60*60;
	var minute	=	1000*60;
	var second	= 	1000;
	var countDownTo = new Date();
		countDownTo.setFullYear(2012,7,25);
		countDownTo.setHours(9,0,0,0);
	
	$(function () {
		var si = setInterval("changeTime()", 1000);
	});
	function changeTime() {
		var today = new Date();
			secondsLeft = Math.floor((countDownTo-today)/second);
			minutesLeft = Math.floor((countDownTo-today)/minute);
			hoursLeft = Math.floor((countDownTo-today)/hour)%24;
			daysLeft = Math.floor((countDownTo-today)/day)%60;
		$('.countdown-timer .seconds').html(":"+Math.floor((secondsLeft/10)%6)+""+secondsLeft%10);
		$('.countdown-timer .minutes').html(":"+Math.floor((minutesLeft/10)%6)+""+minutesLeft%10);
		$('.countdown-timer .hours').html(hoursLeft);
		$('.countdown-timer .days').html(daysLeft);
	}

</script>

*/ ?>